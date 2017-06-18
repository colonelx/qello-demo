<?php

namespace QKidsDemo\Library;

/**
 * Class SessionManager
 * Not really required at this stage, but if we want to extend the session storage.
 * @package QKidsDemo\Services
 */
class SessionManager
{
    /**
     * Set a _SESSION
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Fetch a _SESSION
     * @param $name
     * @return null
     */
    public function get($name)
    {
        return (isset($_SESSION) && isset($_SESSION[$name]))? $_SESSION[$name] : null;
    }
}
