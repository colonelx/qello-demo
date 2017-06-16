<?php

namespace QKidsDemo\Library;

use InvalidArgumentException;
use QKidsDemo\Library\QelloApi as Api;
use QKidsDemo\Model\Device;

class QelloApi
{
    protected $deviceName;
    protected $deviceId;
    protected $apiVersion;

    public function __construct(Device $device, $apiVersion = null)
    {
        $this->deviceId = $device->getId();
        $this->deviceName = $device->getName();
        $this->apiVersion = ($apiVersion)? $apiVersion : '1.0.0';
    }

    public function instance($action)
    {
        switch ($action) {
            case 'users':
                $api = new Api\Users($this);
                break;
            case 'assets':
                $api = new Api\Assets($this);
                break;
            case 'content':
                $api = new Api\Content($this);
                break;
            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $action));
        }
        return $api;
    }

    public function __call($name, $args)
    {
        try {
            return $this->instance($name);
        } catch (InvalidArgumentException $e) {
            throw new \BadMethodCallException(sprintf('Undefined method called: "%s"', $name));
        }
    }

    public function getDeviceName()
    {
        return $this->deviceName;
    }

    public function getDeviceId()
    {
        return $this->deviceId;
    }

    public function getApiVersion()
    {
        return $this->apiVersion;
    }
}
