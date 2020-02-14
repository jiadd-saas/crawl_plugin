<?php
/**
 * @author Haohuang
 * @email  huanghao1054@gmail.com
 * @since   2020/1/7
 */

namespace Jiadd\Gov;


class Account
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $cert;

    /**
     * @var string
     */
    public $basicUrl;

    /**
     * Account constructor.
     * @param $account
     */
    public function __construct($account)
    {
        isset($account['username']) && $this->username = $account['username'];
        isset($account['password']) && $this->password = $account['password'];
        isset($account['cert']) && $this->cert = $account['cert'];
        $this->basicUrl = $account['basic_url'];
    }
}