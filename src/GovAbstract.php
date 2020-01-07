<?php
/**
 * @author: renyuchong
 * Date: 2019-12-17
 * @version 1.0
 */


namespace Gov;

abstract class GovAbstract
{
    /**
     * @var string
     */
    protected $requestUrl;

    /**
     * @var Account
     */
    protected $account;

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
}