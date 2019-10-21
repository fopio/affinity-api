<?php namespace Fopio\AffinityAPI\Responses\Contacts;

use Fopio\AffinityAPI\Objects\AffinityCompanyObject;
use Fopio\AffinityAPI\Objects\AffinityContactObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetContactResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityContactObject;

    public function __construct()
    {
        $this->affinityContactObject = new AffinityContactObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityContactObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityContactObject
    {
        return $this->affinityContactObject;
    }
}