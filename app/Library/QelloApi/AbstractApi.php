<?php

namespace QKidsDemo\Library\QelloApi;

use QKidsDemo\Library\HttpClient\ResponseHandler;
use QKidsDemo\Library\QelloApi;

/**
 * Class AbstractApi
 * @package QKidsDemo\Library\QelloApi
 */
abstract class AbstractApi
{
    protected $apiInstance;

    /**
     * AbstractApi constructor.
     * @param QelloApi $apiInstance
     */
    public function __construct(QelloApi $apiInstance)
    {
        $this->apiInstance = $apiInstance;
    }

    /**
     * @param $path Full url to request
     * @param array $parameters GET params
     * @return Object
     */
    public function get($path, $parameters = [])
    {
        $url = $this->apiInstance->getApiEndpoint($path);
        return $this->apiInstance->getHttpClient()->get($url, $parameters)->getResponse();
    }

    /**
     * @param $path Full url to request
     * @param array $parameters POST parameters
     * @param array $getParameters GET parameters
     * @return Object
     */
    public function post($path, $parameters = [], $getParameters = [])
    {
        $url = $this->apiInstance->getApiEndpoint($path);
        return $this->apiInstance->getHttpClient()->post($url, $parameters, $getParameters)->getResponse();
    }

    /**
     * @param $path Full url to request
     * @param array $parameters GET parameters
     * @return Object
     */
    public function delete($path, $parameters = [])
    {
        $url = $this->apiInstance->getApiEndpoint($path);
        return $this->apiInstance->getHttpClient()->delete($url, $parameters)->getResponse();
    }
}
