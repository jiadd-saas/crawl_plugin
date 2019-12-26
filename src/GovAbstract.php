<?php
/**
 * @author: renyuchong
 * Date: 2019-12-17
 * @version 1.0
 */


namespace Gov;

use Gov\Common\GovConfig;

abstract class GovAbstract
{
    /**
     * 账号
     * @var string
     */
    protected $account;

    /**
     * 密码
     * @var string
     */
    protected $password;

    /**
     * 数字证书
     * @var string
     */
    protected $certificate;

    /**
     * 根据省份 获取 服务器请求数据的url
     * @var string
     */
    protected $province;

    /**
     * 请求python地址url
     * @var string
     */
    protected $requestUrl;

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
            'url' => GovConfig::URL_122[$this->province],
            'szzsid' => $this->certificate,
            'username' => $this->account,
            'password' => $this->password,
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
            'account' => $this->account,
            'school_szkey' => $this->certificate,
            'url' => GovConfig::URL_122[$this->province],
        ], $params);
    }

    protected function buildUrl()
    {
        return $this->requestUrl . '/';
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
            'url' => GovConfig::URL_122[$this->province],
            'username' => $this->account,
            'password' => $this->password,
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
            'url' => GovConfig::URL_122[$this->province],
            'account' => $this->account,
            'password' => $this->password,
        ], $params);
    }
}