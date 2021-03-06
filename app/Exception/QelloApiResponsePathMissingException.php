<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 6/17/17
 * Time: 5:39 PM
 */

namespace QKidsDemo\Exception;

/**
 * Class QelloApiResponsePathMissingException
 * Thrown when we are looking for an non existing element in the API response
 * @package QKidsDemo\Exception
 */
class QelloApiResponsePathMissingException extends QelloApiException
{
    public function __construct($path = "", $call = "", $code = 0)
    {
        parent::__construct(sprintf("Path '%s' does not exist in call '%s'", $path, $call), $code);
    }
}