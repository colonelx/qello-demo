<?php

namespace QKidsDemo\Library\QelloApi;

use QKidsDemo\Exception\QelloApiResponsePathMissingException;
use QKidsDemo\Exception\QelloApiException;

/**
 * Class Users. User related API calls
 * @package QKidsDemo\Library\QelloApi
 */
class Users extends AbstractApi
{
    /**
     * Makes user registration API call
     * @param $email
     * @param $password
     * @param $firstName
     * @param $lastName
     * @return string
     * @throws QelloApiResponsePathMissingException
     */
    public function getToken($email, $password, $firstName, $lastName)
    {
        $params = [
            'email' => $email,
            'password' => $password,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'device_data' => $this->apiInstance->getDeviceData()
        ];

        $response = $this->post('users', $params);

        if(!isset($response->data) || !isset($response->data->token))
            throw new QelloApiResponsePathMissingException("data.token", User::class);

        return $response->data->token;
    }
}
