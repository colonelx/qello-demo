<?php

namespace QKidsDemo\Exception;

class SessionStorageException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message);
    }
}
