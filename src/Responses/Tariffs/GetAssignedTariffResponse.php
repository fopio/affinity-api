<?php namespace Fopio\AffinityAPI\Responses\Tariffs;

use Fopio\AffinityAPI\Objects\AffinityAssignedTariffObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetAssignedTariffResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityAssignedTariffObject;

    public function __construct()
    {
        $this->affinityAssignedTariffObject = new AffinityAssignedTariffObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityAssignedTariffObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityAssignedTariffObject
    {
        return $this->affinityAssignedTariffObject;
    }
}