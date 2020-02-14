<?php
/**
 * @author: renyuchong
 * Date: 2019-12-14
 * @version 1.0
 */

namespace Jiadd\Gov;

use Jiadd\Gov\Common\Curl;
use Jiadd\Gov\Common\GovConfig;
use Jiadd\Gov\Exception\GovException;

class StudentGov extends GovAbstract
{

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
        $url = $this->buildUrl(GovConfig::STUDENT_LOGIN);

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
        $url = $this->buildUrl(GovConfig::AUTO_LOGIN);

        $data = $this->studentLoginBuildParams([
            'usertype' => 2,    //1驾校 2学员
            'student_name' => $params['student_name'],
            'student_phone' => $params['student_phone']
        ]);

        return $this->call($url, $data);
    }

    /**
     * 学员查询考试成绩
     * @param array $params
     * @return bool
     * @throws GovException
     */
    public function getStudentExamScore($params = [])
    {
        //python服务器的地址
        $url = $this->buildUrl(GovConfig::STUDENT_EXAM_SCORE);

        $data = $this->studentBuildParams([]);

        return $this->call($url, $data);
    }

    /**
     * 学员网办进度查询
     * @param array $params
     * User: renyuchong
     * Date: 2019-12-24 15:45
     * @return bool
     * @throws GovException
     */
    public function getStudentNetworkSpeed($params = [])
    {
        //python服务器的地址
        $url = $this->buildUrl(GovConfig::STUDENT_NETWORK_SPEED);

        $data = [];
        isset($params['start_date']) && $data['startTime'] = $params['start_date'];
        isset($params['end_date']) && $data['endTime'] = $params['end_date'];
        isset($params['serial_number']) && $data['lsh'] = $params['serial_number'];
        isset($params['network_serial_number']) && $data['wwlsh'] = $params['network_serial_number'];

        $postData = $this->studentBuildParams($data);

        return $this->call($url, $postData);
    }

    /**
     * 学员网办进度详情查询
     * @param array $params
     * User: renyuchong
     * Date: 2019-12-24 15:50
     * @return bool
     * @throws GovException
     */
    public function getStudentNetworkSpeedDetail($params = [])
    {
        //python服务器的地址
        $url = $this->buildUrl(GovConfig::STUDENT_NETWORK_SPEED_DETAIL);

        $data = $this->studentBuildParams([
            'wwlsh' => $params['network_serial_number'],
        ]);

        return $this->call($url, $data);
    }
}