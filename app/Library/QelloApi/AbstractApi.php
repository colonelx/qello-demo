<?php

namespace QKidsDemo\Library\QelloApi;

use QKidsDemo\Library\HttpClient\ResponseHandler;
use QKidsDemo\Library\QelloApi;

abstract class AbstractApi
{
    protected $apiInstance;

    public function __construct(QelloApi $apiInstance)
    {
        $this->apiInstance = $apiInstance;
    }

    public function get($path, $parameters = [])
    {
        $url = $this->apiInstance->getApiEndpoint($path);
        return $this->apiInstance->getHttpClient()->get($url, $parameters)->getResponse();
    }

    public function post($path, $parameters = [], $getParameters = [])
    {
        $url = $this->apiInstance->getApiEndpoint($path);
        return $this->apiInstance->getHttpClient()->post($url, $parameters, $getParameters)->getResponse();
    }

    public function delete($path, $parameters = [])
    {
        $url = $this->apiInstance->getApiEndpoint($path);
        return $this->apiInstance->getHttpClient()->delete($url, $parameters)->getResponse();
    }
}
