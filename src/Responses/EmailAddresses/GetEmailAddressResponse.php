<?php namespace Fopio\AffinityAPI\Responses\EmailAddresses;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityEmailAddressObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetEmailAddressResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityEmailAddressObject;

    public function __construct()
    {
        $this->affinityEmailAddressObject = new AffinityEmailAddressObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityEmailAddressObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityEmailAddressObject
    {
        return $this->affinityEmailAddressObject;
    }
}