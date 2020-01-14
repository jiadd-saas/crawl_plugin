<?php
/**
 * @author: renyuchong
 * Date: 2019-12-14
 * @version 1.0
 */

namespace Gov;

use Gov\Common\Curl;
use Gov\Common\GovConfig;
use Gov\Exception\GovException;

class DrivingGov extends GovAbstract
{

    /**
     * DrivingGov constructor.
     * @param $url
     * @param array $account
     */
    public function __construct($url, $account = [])
    {
        $this->requestUrl = $url;
        $account && $this->account = new Account($account);
        return $this;
    }

    /**
     * @author Haohuang
     * @email  huanghao1054@gmail.com
     * @since   2020/1/7
     * @param $account
     */
    public function setAccount($account)
    {
        $this->account = new Account($account);
        return $this;
    }

    /**
     * @author Haohuang
     * @email  huanghao1054@gmail.com
     * @since   2020/1/7
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * 驾校登录
     * @param $params
     * @return mixed
     * @author: renyuchong
     * Date: 2019-12-16
     * @throws GovException
     */
    public function drivingLogin($params)
    {
        $url = $this->buildUrl(GovConfig::DRIVING_LOGIN);

        $data = $this->loginBuildParams([
            'school_name' => $params['driving_name'],
            'scene' => 'login',
            'captcha_type' => $params['captcha_type'],
            'csessionid' => $params['csessionid'],
            'sig' => $params['sig'],
            'token' => $params['alitoken'],
            'cookies' => $params['cookies']
        ]);

        return $this->call($url, $data);
    }

    /**
     * 自动登录
     * @param array $params
     * @return mixed
     * @throws \Exception
     * @author: renyuchong
     * Date: 2019-12-16
     */
    public function autoLogin($params = [])
    {
        $url = $this->buildUrl(GovConfig::AUTO_LOGIN);

        $data = $this->loginBuildParams([
            'school_name' => $params['driving_name'],
            'usertype' => 1,    //1驾校
        ]);

        return $this->call($url, $data);
    }

    /**
     * @param $url
     * @param $params
     * @return bool
     * @throws GovException
     * @author: renyuchong
     * Date: 2019-12-18
     */
    private function call($url, $params)
    {
        $curl   = new Curl();
        $json   = $curl->Post($url, $params, 'json');
        $result = json_decode($json, true);

        if( $result['result'] != 0 ){
            throw new GovException($result['message'], $result['result']);
        }

        return $json;
    }

    /**
     * 同步考试计划-通过excel获取的信息
     * @param $params
     * @return mixed
     * @throws \Exception
     * @author: renyuchong
     * Date: 2019-12-17
     */
    public function syncExamPlanExcel($params)
    {
        $url = $this->buildUrl(GovConfig::SYNC_EXAM_PLAN_EXCEL);

        $data = [
            'ykrqstart' => $params['start_date'],
            'ykrqend' => $params['end_date'],
            'downtype' => $params['down_type']
        ];
        isset($params['subject']) && $data['kskm'] = $params['subject'];
        isset($params['car_sort']) && $data['kscx'] = $params['car_sort'];
        isset($params['site_id']) && $data['ksdd'] = $params['site_id'];
        isset($params['student_name']) && $data['xm'] = $params['student_name'];
        isset($params['id_card']) && $data['sfzmhm'] = $params['id_card'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 同步考试计划-返回信息比较少
     * @param $params
     * @return bool
     * @throws GovException
     * @author: renyuchong
     * Date: 2019-12-20
     */
    public function syncExamPlanSimple($params)
    {
        $url = $this->buildUrl(GovConfig::SYNC_EXAM_PLAN_SIMPLE);

        $data = [
            'ykrqstart' => $params['start_date'],
            'ykrqend' => $params['end_date'],
        ];
        isset($params['subject']) && $data['kskm'] = $params['subject'];
        isset($params['car_sort']) && $data['kscx'] = $params['car_sort'];
        isset($params['site_id']) && $data['ksdd'] = $params['site_id'];
        isset($params['student_name']) && $data['xm'] = $params['student_name'];
        isset($params['id_card']) && $data['sfzmhm'] = $params['id_card'];
        isset($params['page']) && $data['page'] = $params['page'];
        isset($params['size']) && $data['size'] = $params['size'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 同步考试计划-查数据库
     * @param $params
     * @return bool
     * @throws GovException
     * @author: renyuchong
     * Date: 2019-12-21
     */
    public function syncExamPlanTable($params)
    {
        $url = $this->buildUrl( GovConfig::SYNC_EXAM_PLAN_TABLE );

        $data = $this->buildParams([
            'start_date' => $params['start_date'],
            'end_date' => $params['end_date']
        ]);

        return $this->call($url, $data);
    }

    /**
     * 同步考试成绩-通过查询excel
     * @param array $params
     * @return mixed
     * @throws \Exception
     * @author: renyuchong
     * Date: 2019-12-17
     */
    public function syncDrivingExamScoreExcel($params)
    {
        $url = $this->buildUrl( GovConfig::SYNC_DRIVING_EXAM_SCORE_EXCEL );

        $data = [
            'ksrqstart' => $params['start_date'],
            'ksrqend' => $params['end_date'],
            'downtype' => $params['down_type']
        ];
        isset($params['subject']) && $data['kskm'] = $params['subject'];
        isset($params['car_sort']) && $data['kscx'] = $params['car_sort'];
        isset($params['site_id']) && $data['ksdd'] = $params['site_id'];
        isset($params['student_name']) && $data['xm'] = $params['student_name'];
        isset($params['id_card']) && $data['sfzmhm'] = $params['id_card'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 同步考试成绩-返回信息比较少
     * @param $params
     * @return bool
     * @throws GovException
     * @author: renyuchong
     * Date: 2019-12-23
     */
    public function syncDrivingExamScoreSimple($params)
    {
        $url = $this->buildUrl( GovConfig::SYNC_DRIVING_EXAM_SCORE_SIMPLE );

        $data = [
            'ksrqstart' => $params['start_date'],
            'ksrqend' => $params['end_date']
        ];
        isset($params['subject']) && $data['kskm'] = $params['subject'];
        isset($params['car_sort']) && $data['kscx'] = $params['car_sort'];
        isset($params['site_id']) && $data['ksdd'] = $params['site_id'];
        isset($params['student_name']) && $data['xm'] = $params['student_name'];
        isset($params['id_card']) && $data['sfzmhm'] = $params['id_card'];
        isset($params['page']) && $data['page'] = $params['page'];
        isset($params['size']) && $data['size'] = $params['size'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 同步考试成绩-数据库
     * @param $params
     * @return bool
     * @throws GovException
     * @author: renyuchong
     * Date: 2019-12-24
     */
    public function syncDrivingExamScoreTable($params)
    {
        //python服务器的地址
        $url = $this->buildUrl( GovConfig::SYNC_DRIVING_EXAM_SCORE_TABLE );

        $data = $this->buildParams([
            'start_date' => $params['start_date'],
            'end_date' => $params['end_date']
        ]);

        return $this->call($url, $data);
    }

    /**
     * @param $params
     * @return mixed
     * @author: renyuchong
     * @throws GovException
     * Date: 2019-12-18
     */
    public function getAliToken($params)
    {
        $url = $this->buildUrl( GovConfig::GET_ALITOKEN );

        $data = [
            'url'       => $this->account->basicUrl,
            'usertype'  => $params['user_type']
        ];

        return $this->call($url, $data);
    }

    /**
     * 获取图片验证码的类型
     * @param $params
     * @return bool
     * @throws GovException
     * @author: renyuchong
     * Date: 2019-12-19
     */
    public function getCaptchaType($params)
    {
        $url = $this->buildUrl( GovConfig::GET_CAPTCHA_TYPE );

        $data = [
            'url'       => $this->account->basicUrl,
            'cookies'   => $params['cookies'],
            'checktype' => GovConfig::CHECK_TYPE
        ];

        return $this->call($url, $data);
    }

    /**
     * 计算验证码
     * @param $params
     * @return bool
     * @throws GovException
     * @author: renyuchong
     * Date: 2019-12-19
     */
    public function getCaptchaCountImg($params)
    {
        $url = $this->buildUrl( GovConfig::CAPTCHA_COUNT_IMG );
        $data = [
            'url'       => $this->account->basicUrl,
            'cookies'   => $params['cookies']
        ];
        return $this->call($url, $data);
    }

    /**
     * GIF验证码
     * @param $params
     * @return bool
     * @throws GovException
     * @author: renyuchong
     * Date: 2019-12-19
     */
    public function getCaptchaGifImg($params)
    {
        $url = $this->buildUrl( GovConfig::CAPTCHA_GIF_IMG );
        $data = [
            'url'       => $this->account->basicUrl,
            'cookies'   => $params['cookies']
        ];
        return $this->call($url, $data);
    }

    /**
     * 驾校考试场地查询
     * @param $params
     * User: renyuchong
     * Date: 2020-01-14 15:49
     * @return bool
     * @throws GovException
     */
    public function getSchoolExamSite($params)
    {
        $url = $this->buildUrl( GovConfig::SCHOOL_EXAM_SITE );

        $data = [];
        isset($params['subject']) && $data['kskm'] = $params['subject'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 打印注册申请表
     * @param $params
     * User: renyuchong
     * Date: 2019-12-30 11:11
     * @throws GovException
     * @return json
     */
    public function getRegisterPdf($params)
    {
        $url = $this->buildUrl() . GovConfig::PRE_REGISTER_PDF;

        $data = [
            'ksrqstart' => $params['start_date'],
            'ksrqend' => $params['end_date']
        ];
        isset($params['subject']) && $data['kskm'] = $params['subject'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-检查身份证
     * @param $params
     * User: renyuchong
     * Date: 2019-12-30 16:51
     * @return bool
     * @throws GovException
     */
    public function getCheckIdCard($params)
    {
        $url = $this->buildUrl() . GovConfig::PRE_CHECK_ID_CARD;

        $data = [
            'ksrqstart' => $params['start_date'],
            'ksrqend' => $params['end_date']
        ];
        isset($params['subject']) && $data['kskm'] = $params['subject'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-保存受理信息
     * @param $params
     * User: renyuchong
     * Date: 2019-12-30 17:11
     * @return bool
     * @throws GovException
     */
    public function savePreEntryInfo($params)
    {
        $url = $this->buildUrl() . GovConfig::SAVE_PRE_ENTRY_INFO;

        $data = [
            'ksrqstart' => $params['start_date'],
            'ksrqend' => $params['end_date']
        ];
        isset($params['subject']) && $data['kskm'] = $params['subject'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-获取行政区域码
     * @param $params
     * User: renyuchong
     * Date: 2019-12-30 17:25
     * @return bool
     * @throws GovException
     */
    public function savePreAreaCode($params)
    {
        $url = $this->buildUrl() . GovConfig::PRE_AREA_CODE;

        $data = [
            'ksrqstart' => $params['start_date'],
            'ksrqend' => $params['end_date']
        ];
        isset($params['subject']) && $data['kskm'] = $params['subject'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-获取驾驶证申请表
     * @param $params
     * User: renyuchong
     * Date: 2019-12-30 17:30
     * @return bool
     * @throws GovException
     */
    public function getPreDriverLicensePdf($params)
    {
        $url = $this->buildUrl() . GovConfig::PRE_DRIVER_LICENSE_PDF;

        $data = [
            'ksrqstart' => $params['start_date'],
            'ksrqend' => $params['end_date']
        ];
        isset($params['subject']) && $data['kskm'] = $params['subject'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

}