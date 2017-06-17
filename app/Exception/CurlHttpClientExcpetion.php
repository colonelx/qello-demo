<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 6/17/17
 * Time: 7:08 PM
 */

namespace QKidsDemo\Exception;


class CurlHttpClientExcpetion extends \Exception
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}