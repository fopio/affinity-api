<?php namespace Fopio\AffinityAPI\Responses\Tariffs;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityTariffObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetTariffResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTariffObject;

    public function __construct()
    {
        $this->affinityTariffObject = new AffinityTariffObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityTariffObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityTariffObject
    {
        return $this->affinityTariffObject;
    }
}