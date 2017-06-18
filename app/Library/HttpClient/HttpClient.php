<?php

namespace QKidsDemo\Library\HttpClient;

/**
 * Class HttpClient. Creates a Request and passes the response
 * @package QKidsDemo\Library\HttpClient
 */
class HttpClient
{
    /**
     * Handles GET requests
     * @param $path
     * @param $parameters
     * @return ResponseHandler
     */
    public function get($path, $parameters)
    {
        $requestBuilder = new RequestBuilder('GET', $path, $parameters);
        return $requestBuilder->getResponse();
    }

    /**
     * Handles POST requests
     * @param $path
     * @param $bodyParameters
     * @param $getParameters
     * @return ResponseHandler
     */
    public function post($path, $bodyParameters, $getParameters)
    {
        $requestBuilder = new RequestBuilder('POST', $path, $getParameters, $bodyParameters);
        return $requestBuilder->getResponse();
    }

    /**
     * Handles DELETE requests
     * @param $path
     * @param $parameters
     * @return ResponseHandler
     */
    public function delete($path, $parameters)
    {
        $requestBuilder = new RequestBuilder('DELETE', $path, $parameters);
        return $requestBuilder->getResponse();
    }
}
