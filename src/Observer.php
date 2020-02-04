<?php
/**
 * Created by PhpStorm.
 * User: huanghao
 * Date: 2020/2/4
 * Time: 2:05 PM
 */

namespace Gov;


abstract class Observer
{

    public function before($url, $params) {}

    public function after($url, $params, $result) {}
}