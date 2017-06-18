<?php

namespace QKidsDemo\Library\HttpClient;

use phpDocumentor\Reflection\Types\Object_;
use QKidsDemo\Exception\QelloApiErrorException;
use QKidsDemo\Exception\QelloApiException;

/**
 * Class ResponseHandler. Handles the plain text response from the API
 * @package QKidsDemo\Library\HttpClient
 */
class ResponseHandler
{
    protected $plainResponse;
    protected $response;

    /**
     * ResponseHandler constructor.
     * @param $plainResponse String
     */
    public function __construct($plainResponse)
    {
        $this->plainResponse = $plainResponse;
        $this->handle();
    }

    /**
     * Handles the conversion and checks for errors
     * @throws QelloApiErrorException
     * @throws QelloApiException
     */
    protected function handle()
    {
        $response = json_decode($this->plainResponse);

        if(!isset($response) ||
            !isset($response->status) ||
            !isset($response->status->success) ||
            json_last_error() !== JSON_ERROR_NONE)
        {
            throw new QelloApiException(
                sprintf("Server does not return a valid response: [%s]", $this->plainResponse));
        }

        if($response->status->success == true)
        {
            $this->response = $response;
        } elseif ($response->status->success == false) {
            throw new QelloApiErrorException($response->status->message, $response->status->error);
        } else {
            throw new QelloApiException(
                sprintf("Server does not return a valid response: [%s]", $this->plainResponse));
        }
    }

    /**
     * @return Object
     */
    public function getResponse()
    {
        return $this->response;
    }

}
