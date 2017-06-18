<?php

namespace QKidsDemo\Model;

/**
 * Class Device
 * @package QKidsDemo\Model
 */
class Device
{
    protected $id;
    protected $name;

    /**
     * @return string
     */
    public function getId()
    {
        return uniqid();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}