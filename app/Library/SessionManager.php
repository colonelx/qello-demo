<?php

namespace QKidsDemo\Library;

/**
 * Class SessionManager
 * @package QKidsDemo\Services
 *
 * Not really required at this stage, but if we want to extend the session storage.
 */
class SessionManager
{
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        return (isset($_SESSION) && isset($_SESSION[$name]))? $_SESSION[$name] : null;
    }
}