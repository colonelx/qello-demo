<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 6/17/17
 * Time: 8:27 AM
 */

namespace QKidsDemo\Exception;


class QelloApiException extends \Exception
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }

}