<?php

namespace QKidsDemo\Exception;

/**
 * Class QelloApiException
 * Thrown when an unknown HTTP error occurs with an API request
 * @package QKidsDemo\Exception
 */
class QelloApiException extends \Exception
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }

}