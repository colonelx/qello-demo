<?php

namespace QKidsDemo\Library\QelloApi;

class Users extends AbstractApi
{
    public function getToken($email, $password, $firstName, $lastName)
    {
        $params = [
            'email' => $email,
            'password' => $password,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'device_data' => $this->apiInstance->getDeviceData()
        ];

        $response = $this->post('users', $params)->getResponse();
        return $response->data->token;
    }
}
