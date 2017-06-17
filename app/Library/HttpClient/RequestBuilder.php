<?php

namespace QKidsDemo\Library\HttpClient;

class RequestBuilder
{
    protected $method;
    protected $url;
    protected $headers;
    protected $bodyParameters;
    protected $getParameters;
    protected $curlInstance;

    public function __construct($method, $url, $getParameters = [], $bodyParameters = [])
    {
        $this->method = $method;
        $this->url = $url;
        $this->headers = [];
        $this->bodyParameters = $bodyParameters;
        $this->getParameters = $getParameters;
    }

    public function addHeader($name, $value)
    {
        $this->headers[] = "{$name}: {$value}";
    }

    public function getResponse()
    {
        $this->curlInstance = curl_init();

        curl_setopt($this->curlInstance, CURLOPT_RETURNTRANSFER, 1);

        $url_suffix = '';
        if ($this->method == 'POST') {
            curl_setopt($this->curlInstance, CURLOPT_POST, 1);

            if (sizeof($this->bodyParameters) > 0) {
                curl_setopt($this->curlInstance, CURLOPT_POSTFIELDS, http_build_query($this->bodyParameters));
            }
        }

        if ($this->method == 'DELETE') {
            curl_setopt($this->curlInstance, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        if (sizeof($this->getParameters) > 0) {
            $url_suffix = '?' . http_build_query($this->getParameters);
        }

        if (sizeof($this->headers) > 0) {
            curl_setopt($this->curlInstance, CURLOPT_HTTPHEADER, $this->headers);
        }

        curl_setopt($this->curlInstance, CURLOPT_URL, $this->url . $url_suffix);

        $output = curl_exec($this->curlInstance);

        curl_close($this->curlInstance);

        return $output;
    }
}
