<?php

namespace QKidsDemo\Library;

use InvalidArgumentException;
use QKidsDemo\Library\HttpClient\HttpClient;
use QKidsDemo\Library\QelloApi as Api;
use QKidsDemo\Model\Device;

/**
 * Class QelloApi
 * Client class
 * @package QKidsDemo\Library
 */
class QelloApi
{
    protected $deviceName;
    protected $deviceId;
    protected $appVersion;
    protected $apiEndpoint;
    protected $httpClient;
    protected $token;

    /**
     * QelloApi constructor.
     * @param $apiEndpoint
     * @param null $token
     * @param Device|null $device
     * @param null $appVersion
     */
    public function __construct($apiEndpoint, $token = null, Device $device = null, $appVersion = null)
    {
        $url = parse_url($apiEndpoint);
        $safeUrl = $url['scheme']."://".$url['host'];

        $this->apiEndpoint = $safeUrl;
        $this->deviceId = ($device)? $device->getId() : '';
        $this->deviceName = ($device)? $device->getName() : '';
        $this->appVersion = ($appVersion)? $appVersion : '1.0.0';
        $this->token = $token;
        $this->httpClient = new HttpClient();
    }

    /**
     * Creates an API call instance for the given API endpoint
     * @param $action
     * @param array $args
     * @return Api\Collection|Api\Content|Api\Users
     * @throws InvalidArgumentException
     */
    public function instance($action, $args = [])
    {
        switch ($action) {
            case 'users':
                $api = new Api\Users($this);
                break;
            case 'collection':
                $api = new Api\Collection($this);
                break;
            case 'content':
                $api = new Api\Content($this, $args);
                break;
            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $action));
        }
        return $api;
    }

    /**
     * @param $name
     * @param $args
     * @return Api\Collection|Api\Content|Api\Users
     */
    public function __call($name, $args)
    {
        try {
             return $this->instance($name, $args);
        } catch (InvalidArgumentException $e) {
            throw new \BadMethodCallException(sprintf('Undefined method called: "%s"', $name));
        }
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Required data for the Registration call
     * @return array
     */
    public function getDeviceData()
    {
        return [
            'device_id' => $this->deviceId,
            'device_name' => $this->deviceName,
            'app_version' => $this->appVersion
        ];
    }

    /**
     * Constructs the HTTP url to call
     * @param $path
     * @return string
     */
    public function getApiEndpoint($path)
    {

        return $this->apiEndpoint . '/' . $path;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}
