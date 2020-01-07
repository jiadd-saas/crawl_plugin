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
        $this->username = $account['username'];
        $this->password = $account['password'];
        $this->cert     = $account['cert'];
        $this->basicUrl = $account['basic_url'];
    }
}