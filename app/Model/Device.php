<?php

namespace QKidsDemo\Model;


class Device
{
    protected $id;
    protected $name;

    public function getId()
    {
        return uniqid();
    }

    public function getName()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}