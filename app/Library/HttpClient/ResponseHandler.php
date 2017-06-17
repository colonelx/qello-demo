<?php

namespace QKidsDemo\Library\HttpClient;

use QKidsDemo\Exception\QelloApiErrorException;
use QKidsDemo\Exception\QelloApiException;

class ResponseHandler
{
    protected $plainResponse;
    protected $response;
    public function __construct($plainResponse)
    {
        $this->plainResponse = $plainResponse;
        $this->handle();
        return $this;
    }

    protected function handle()
    {
        $response = json_decode($this->plainResponse);

        if($response->status->success === true)
        {
            $this->response = $response;
        } elseif ($response->status->success === false) {
            throw new QelloApiErrorException($response->status->message, $response->status->error);
        } else {
            throw new QelloApiException(
                printf("Server does not return a valid response: [%s]", $this->plainResponse));
        }
    }

    public function getResponse()
    {
        return $this->response;
    }
}
