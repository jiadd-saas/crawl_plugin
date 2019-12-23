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

class StudentGov extends GovAbstract
{
    /**
     * DrivingGov constructor.
     * @param string $account 账户
     * @param string $password 密码
     * @param string $province 省份 如：北京市、河北省，GovConfig::LOGIN_122_URL
     */
    public function __construct($account = '', $password = '', $province = '')
    {
        $this->account = $account;
        $this->password = $password;
        $this->province = $province;
    }

    /**
     * 学员登录
     * @param $params
     * @return mixed
     * @author: renyuchong
     * Date: 2019-12-16
     * @throws GovException
     */
    public function studentLogin($params)
    {
        //python服务器的地址
        $url = $this->buildUrl($params['url']) . GovConfig::STUDENT_LOGIN;

        $data = $this->studentLoginBuildParams([
            'student_name' => $params['student_name'],
            'student_phone' => $params['student_phone'],
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
        //python服务器的地址
        $url = $this->buildUrl($params['url']) . GovConfig::AUTO_LOGIN;

        $data = $this->studentLoginBuildParams([
            'usertype' => 2,    //1驾校 2学员
            'student_name' => $params['student_name'],
            'student_phone' => $params['student_phone']
        ]);

        return $this->call($url, $data);
    }

    /**
     * @param $url
     * @param $params
     * @return bool
     * @throws GovException
     * @throws \Exception
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
}