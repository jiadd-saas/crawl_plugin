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
     * 预录入-打印注册申请表
     * @param $params
     * User: renyuchong
     * Date: 2019-12-30 11:11
     * @throws GovException
     * @return json
     */
    public function getRegisterPdf($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_REGISTER_PDF);

        $data = [
            'wwlsh' => $params['network_serial_number'],
        ];

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
        $url = $this->buildUrl(GovConfig::PRE_CHECK_ID_CARD);

        $data = [
            'sfzmmc' => $params['papers_type'],
            'sfzmhm' => $params['papers_number']
        ];

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
        $url = $this->buildUrl(GovConfig::SAVE_PRE_ENTRY_INFO);

        $data = [
            'SFZMMC' => $params['card_type'],
            'SFZMHM' => $params['card_number'],
            'SJHM' => $params['phone'],
            'XM' => $params['real_name'],
            'XB' => $params['sex'],
            'CSRQ' => $params['birth_date'],
            'MODAL' => $params['modal'],
            'SFZC2' => $params['is_face_sign']
        ];
        isset($params['email']) && $data['DZYX'] = $params['email'];
        isset($params['car_type']) && $data['ZKCX'] = $params['car_type'];
        isset($params['residence_cert']) && $data['ZZZM'] = $params['residence_cert'];
        isset($params['landline']) && $data['LXDH'] = $params['landline'];
        isset($params['area_code']) && $data['XZQH'] = $params['area_code'];
        isset($params['postal_code']) && $data['YZBM'] = $params['postal_code'];
        isset($params['mail_address']) && $data['YJDZ'] = $params['mail_address'];
        isset($params['source']) && $data['LY'] = $params['source'];
        isset($params['contact_address']) && $data['LXZSXXDZ'] = $params['contact_address'];
        isset($params['contact_area_code']) && $data['LXZSXZQH'] = $params['contact_area_code'];
        isset($params['register_address']) && $data['DJZSXXDZ'] = $params['register_address'];
        isset($params['register_area_code']) && $data['DJZSXZQH'] = $params['register_area_code'];
        isset($params['country']) && $data['GJ'] = $params['country'];
        isset($params['card_expire_date']) && $data['SFZYXQZ'] = $params['card_expire_date'];
        isset($params['bs']) && $data['BS'] = $params['bs'];

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
        $url = $this->buildUrl(GovConfig::PRE_AREA_CODE);

        $data = [
            'xzqhmc' => $params['area_code'],
        ];

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
        $url = $this->buildUrl(GovConfig::PRE_DRIVER_LICENSE_PDF);

        $data = [
            'wwlsh' => $params['network_serial_number'],
        ];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-上传受理照片
     * @param $params
     * User: renyuchong
     * Date: 2020-02-04 15:47
     * @return bool
     * @throws GovException
     */
    public function uploadAcceptImage($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_UPLOAD_ACCEPT_IMAGE);

        $data = [
            'wwlsh' => $params['network_serial_number'],
            'bz' => $params['image_type'],
            'para1' => $params['para1'],
            'para2' => $params['para2'],
            'img_name' => $params['img_name'],  //trackdata
            'submitted' => $params['submitted'],
            'trackdata' => $params['trackdata'],
        ];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-上传照片前获取加密密钥
     * @param $params
     * User: renyuchong
     * Date: 2020-02-04 15:54
     * @return bool
     * @throws GovException
     */
    public function getUploadImageEncryptKey($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_GET_UPLOAD_IMAGE_ENCRYPT_KEY);

        $data = [];
        isset($params['network_serial_number']) && $data['wwlsh'] = $params['network_serial_number'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-上传照片前进行setdecrypt
     * @param $params
     * User: renyuchong
     * Date: 2020-02-04 16:09
     * @return bool
     * @throws GovException
     */
    public function setUploadImageDecryptKey($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_SET_UPLOAD_IMAGE_DECRYPT_KEY);

        $data = [
            'rasdecrypt' => $params['rasdecrypt'],
        ];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-旧的注册申请表
     * @param $params
     * User: renyuchong
     * Date: 2020-02-04 18:14
     * @return bool
     * @throws GovException
     */
    public function getRegisterPdfOld($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_REGISTER_PDF_OLD);

        $data = [
            'sfzmmc' => $params['card_type'],
            'sfzmhm' => $params['card_number'],
            'sjhm' => $params['phone'],
            'xm' => $params['real_name'],
            'xb' => $params['sex'],
            'csrq' => $params['birth_date'],
            'yzbm' => $params['postal_code'],
            'yjdz' => $params['mail_address'],
        ];
        isset($params['email']) && $data['dzyx'] = $params['email'];
        isset($params['province']) && $data['dqsf'] = $params['province'];
        isset($params['city']) && $data['dqcs'] = $params['city'];
        isset($params['area']) && $data['dqqh'] = $params['area'];
        //暂时没有用到
        isset($params['user_code']) && $data['yhdh'] = $params['user_code'];
        isset($params['yhlx']) && $data['yhlx'] = $params['yhlx'];
        isset($params['serial_number']) && $data['lsh'] = $params['serial_number'];
        isset($params['ywlx']) && $data['ywlx'] = $params['ywlx'];
        isset($params['license_plate']) && $data['fzjg'] = $params['license_plate'];    //车牌信息
        isset($params['mm']) && $data['mm'] = $params['mm'];
        isset($params['zt']) && $data['zt'] = $params['zt'];
        isset($params['backUrl']) && $data['backUrl'] = $params['backUrl'];
        isset($params['sfmq']) && $data['sfmq'] = $params['sfmq'];
        isset($params['card_expire_date']) && $data['sfzyxqz'] = $params['card_expire_date'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-获取驾照照片流水号
     * @param $params
     * User: renyuchong
     * Date: 2020-02-04 18:18
     * @return bool
     * @throws GovException
     */
    public function getImageSerialNumber($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_GET_DRIVER_IMAGE_SERIAL_NUMBER);

        $data = [
            'sfzmhm' => $params['card_number'],
        ];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-上传驾照照片
     * @param $params
     * User: renyuchong
     * Date: 2020-02-05 11:36
     * @return bool
     * @throws GovException
     */
    public function uploadDriverImage($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_UPLOAD_DRIVER_IMAGE);

        $data = [
            'wwlsh' => $params['network_serial_number'],
            'fzjg' => $params['license_plate'],
            'sfzmhm' => $params['card_number'],
            'trackdata' => $params['trackdata'],
            'img_name' => $params['img_name'],  //trackdata
            'bz' => $params['bz'],  //test
        ];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-上传身份证电子照片
     * @param $params
     * User: renyuchong
     * Date: 2020-02-04 18:48
     * @return bool
     * @throws GovException
     */
    public function uploadIdCardImage($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_UPLOAD_ID_CARD_IMAGE);

        $data = [
            'yhdh' => $params['card_number'],
            'picture' => $params['picture'],
        ];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-提交预录入受理
     * @param $params
     * User: renyuchong
     * Date: 2020-02-04 18:53
     * @return bool
     * @throws GovException
     */
    public function submitPreEntryAccept($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_SUBMIT_ENTRY_ACCEPT);

        $data = [
            'wwlsh' => $params['network_serial_number'],
            'ly' => $params['source'],
        ];
        isset($params['photo_network_serial_number']) && $data['zpwwlsh'] = $params['photo_network_serial_number'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 预录入-驾校受理查询接口
     * @param $params
     * User: renyuchong
     * Date: 2020-02-04 19:04
     * @return bool
     * @throws GovException
     */
    public function driverInquireAcceptInfo($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_DRIVER_INQUIRE_ACCEPT_INFO);

        $data = [
            'gxrqstart' => $params['start_date'],
            'gxrqend' => $params['end_date'],
        ];
        isset($params['input_person']) && $data['yhdh'] = $params['input_person'];
        isset($params['car_sort']) && $data['zkcx'] = $params['car_sort'];
        isset($params['business_type']) && $data['ywzt'] = $params['business_type'];
        isset($params['real_name']) && $data['xm'] = $params['real_name'];
        isset($params['card_type']) && $data['sfzmmc'] = $params['card_type'];
        isset($params['card_number']) && $data['sfzmhm'] = $params['card_number'];
        isset($params['page']) && $data['page'] = $params['page'];
        isset($params['size']) && $data['size'] = $params['size'];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 生成个人用户注册seed接口
     * @param $params
     * User: renyuchong
     * Date: 2020-02-04 19:08
     * @return bool
     * @throws GovException
     */
    public function createIndividualRegisterSeed($params)
    {
        $url = $this->buildUrl(GovConfig::PRE_CREATE_INDIVIDUAL_REGISTER_SEED);

        $data = [];

        $postData = $this->buildParams($data);

        return $this->call($url, $postData);
    }
}