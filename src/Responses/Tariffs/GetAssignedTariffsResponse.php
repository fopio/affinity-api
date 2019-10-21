<?php namespace Fopio\AffinityAPI\Responses\Tariffs;

use Fopio\AffinityAPI\Objects\AffinityAssignedTariffObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetAssignedTariffsResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTariffObject;

    protected $affinity_assigned_tariff_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_tariff_objects = [];

        if(isset($affinity_response->SiteProductTariffSchemes->SiteProductTariffScheme)){
            foreach($affinity_response->ProductTariffSchemes->ProductTariffScheme as $affinity_assigned_tariff){
                $this->appendObject($affinity_assigned_tariff);
            }
        }elseif(isset($affinity_response->SiteProductTariffScheme)){
            $this->appendObject($affinity_response->SiteProductTariffScheme);
        }

        return $this;
    }

    protected function appendObject($affinity_assigned_tariff){
        $affinity_tariff_object = new AffinityAssignedTariffObject();

        $affinity_tariff_object->setObject($affinity_assigned_tariff);

        $this->affinity_assigned_tariff_objects[] = $affinity_tariff_object;
    }


    public function getResponse(): array
    {
        return $this->affinity_assigned_tariff_objects;
    }
}