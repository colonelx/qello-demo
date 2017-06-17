<?php

namespace QKidsDemo\Library\HttpClient;

class HttpClient
{

    public function get($path, $parameters)
    {
        $request = new RequestBuilder('GET', $path, $parameters);
        return new ResponseHandler($request->getResponse());
    }

    public function post($path, $bodyParameters, $getParameters)
    {
        $request = new RequestBuilder('POST', $path, $getParameters, $bodyParameters);
        return new ResponseHandler($request->getResponse());
    }

    public function delete($path, $parameters)
    {
        $request = new RequestBuilder('DELETE', $path, $parameters);
        return new ResponseHandler($request->getResponse());
    }
}
