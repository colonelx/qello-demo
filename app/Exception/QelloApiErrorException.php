<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 6/17/17
 * Time: 8:47 AM
 */

namespace QKidsDemo\Exception;


class QelloApiErrorException  extends QelloApiException
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}