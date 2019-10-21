<?php namespace Fopio\AffinityAPI\Responses\Contracts;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityContractObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetContractResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityContractObject;

    public function __construct()
    {
        $this->affinityContractObject = new AffinityContractObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityContractObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityContractObject
    {
        return $this->affinityContractObject;
    }
}