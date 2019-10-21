<?php namespace Fopio\AffinityAPI\Responses\Companies;

use Fopio\AffinityAPI\Objects\AffinityCompanyObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetCompanyResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityCompanyObject;

    public function __construct()
    {
        $this->affinityCompanyObject = new AffinityCompanyObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityCompanyObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityCompanyObject
    {
        return $this->affinityCompanyObject;
    }
}