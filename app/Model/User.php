<?php

namespace QKidsDemo\Model;


class User
{
    protected $id;
    protected $email;
    protected $firstName;
    protected $lastName;
    protected $token;
    protected $refreshKey;

    public function __construct($id, $email, $firstName, $lastName, $token, $refreshKey)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->token = $token;
        $this->refreshKey = $refreshKey;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getToken()
    {
        return $this->token;
    }
}