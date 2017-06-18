<?php

namespace QKidsDemo\Model;

/**
 * Class User
 * @package QKidsDemo\Model
 */
class User
{
    protected $id;
    protected $email;
    protected $firstName;
    protected $lastName;
    protected $token;
    protected $refreshKey;

    /**
     * User constructor.
     * @param $id int
     * @param $email string
     * @param $firstName string
     * @param $lastName string
     * @param $token string
     * @param $refreshKey string
     */
    public function __construct($id, $email, $firstName, $lastName, $token, $refreshKey)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->token = $token;
        $this->refreshKey = $refreshKey;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}