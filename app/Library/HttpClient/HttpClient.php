<?php

namespace QKidsDemo\Library\HttpClient;

class HttpClient
{

    public function get($path, $parameters)
    {
        $requestBuilder = new RequestBuilder('GET', $path, $parameters);
        return $requestBuilder->getResponse();
    }

    public function post($path, $bodyParameters, $getParameters)
    {
        $requestBuilder = new RequestBuilder('POST', $path, $getParameters, $bodyParameters);
        return $requestBuilder->getResponse();
    }

    public function delete($path, $parameters)
    {
        $requestBuilder = new RequestBuilder('DELETE', $path, $parameters);
        return $requestBuilder->getResponse();
    }
}
