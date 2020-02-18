<?php
/**
 * @author: renyuchong
 * Date: 2019-12-17
 * @version 1.0
 */


namespace Jiadd\Gov;

use Jiadd\Gov\Common\Curl;
use Jiadd\Gov\Exception\GovException;

abstract class GovAbstract
{
    /**
     * @var string
     */
    protected $requestUrl;

    /**
     * @var Account
     */
    public $account;

    /**
     * @var array
     */
    protected $observers = [];

    /**
     * DrivingGov constructor.
     * @param $url
     * @param array $account
     */
    public function __construct($url, $account = [])
    {
        $this->requestUrl = $url;
        if( $account ) {
            $this->account = new Account($account);
        }
    }

    /**
     * 登录公用的参数
     * @param $params
     * @return array
     * @author: renyuchong
     * Date: 2019-12-19
     */
    protected function loginBuildParams($params)
    {
        return array_merge([
            'url'       => $this->account->basicUrl,
            'szzsid'    => $this->account->cert,
            'username'  => $this->account->username,
            'password'  => $this->account->password,
        ], $params);
    }

    /**
     * 其它请求接口公用参数
     * @param $params
     * @return array
     * @author: renyuchong
     * Date: 2019-12-19
     */
    protected function buildParams($params)
    {
        return array_merge([
            'url'           => $this->account->basicUrl,
            'account'       => $this->account->username,
            'school_szkey'  => $this->account->cert,
        ], $params);
    }

    public function buildUrl($url)
    {
        return rtrim($this->requestUrl, '/') . '/' . $url;
    }

    /**
     * 学员登录绑定参数
     * @param $params
     * @return array
     * @author: renyuchong
     * Date: 2019-12-19
     */
    protected function studentLoginBuildParams($params)
    {
        return array_merge([
            'url'       => $this->account->basicUrl,
            'username'  => $this->account->username,
            'password'  => $this->account->password,
        ], $params);
    }

    /**
     * 学员请求绑定参数
     * @param $params
     * @return array
     */
    protected function studentBuildParams($params)
    {
        return array_merge([
            'url'       => $this->account->basicUrl,
            'account'   => $this->account->username,
            'password'  => $this->account->password,
        ], $params);
    }

    /**
     * @author Haohuang
     * @email  huanghao1054@gmail.com
     * @param $url
     * @param $params
     * @throws GovException
     * @return string
     */
    protected function call($url, $params, $parType='json')
    {
        $curl   = new Curl();
        $json   = $curl->Post($url, $params, $parType);
        $result = json_decode($json, true);

        $this->notify('after', [
            'url'       => $url,
            'params'    => $params,
            'result'    => $result
        ]);

        if( $result['result'] != 0 ){
            throw new GovException($result['message'], $result['result']);
        }
        return $json;
    }

    /**
     * @author Haohuang
     * @email  huanghao1054@gmail.com
     * @param $observer
     * @return $this
     */
    public function attach($observer)
    {
        $this->observers[] = $observer;
        return $this;
    }

    /**
     * @author Haohuang
     * @email  huanghao1054@gmail.com
     * @param $type
     * @param array $params
     */
    protected function notify($type, $params = [])
    {
        foreach ( $this->observers as $observer ) {
            if( $observer instanceof Observer ) {
                call_user_func_array([$observer, $type], $params);
            }
        }
    }
}