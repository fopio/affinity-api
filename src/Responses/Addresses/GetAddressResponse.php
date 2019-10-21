<?php namespace Fopio\AffinityAPI\Responses\Addresses;

use Fopio\AffinityAPI\Objects\AffinityAddressObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetAddressResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityAddressObject;

    public function __construct()
    {
        $this->affinityAddressObject = new AffinityAddressObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityAddressObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityAddressObject
    {
        return $this->affinityAddressObject;
    }
}