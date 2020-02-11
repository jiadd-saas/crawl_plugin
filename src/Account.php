<?php
/**
 * @author Haohuang
 * @email  huanghao1054@gmail.com
 * @since   2020/1/7
 */

namespace Gov;


class Account
{
    public $username;

    public $password;

    public $cert;

    public $basicUrl;

    public function __construct($account)
    {
        isset($account['username']) && $this->username = $account['username'];
        isset($account['password']) && $this->password = $account['password'];
        isset($account['cert']) && $this->cert = $account['cert'];
        $this->basicUrl = $account['basic_url'];
    }
}