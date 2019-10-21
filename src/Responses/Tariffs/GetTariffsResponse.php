<?php namespace Fopio\AffinityAPI\Responses\Tariffs;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityTariffObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetTariffsResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTariffObject;

    protected $affinity_tariff_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_tariff_objects = [];

        if(isset($affinity_response->ProductTariffSchemes->ProductTariffScheme)){
            foreach($affinity_response->ProductTariffSchemes->ProductTariffScheme as $affinity_tariff){
                $this->appendObject($affinity_tariff);
            }
        }elseif(isset($affinity_response->ProductTariffScheme)){
           $this->appendObject($affinity_response->ProductTariffScheme);
        }

        return $this;
    }

    protected function appendObject($affinity_tariff){
        $affinity_tariff_object = new AffinityTariffObject();

        $affinity_tariff_object->setObject($affinity_tariff);

        $this->affinity_tariff_objects[] = $affinity_tariff_object;
    }

    public function getResponse(): array
    {
        return $this->affinity_tariff_objects;
    }
}