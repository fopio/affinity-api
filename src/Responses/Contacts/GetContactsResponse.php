<?php namespace Fopio\AffinityAPI\Responses\Contacts;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityCompanyObject;
use Fopio\AffinityAPI\Objects\AffinityContactObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetContactsResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityContactObject;

    protected $affinity_contact_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_contact_objects = [];

        if(isset($affinity_response->ProductTariffSchemes->ProductTariffScheme)){
            foreach($affinity_response->ProductTariffSchemes->ProductTariffScheme as $affinity_contact){
                $this->appendObject($affinity_contact);
            }
        }elseif(isset($affinity_response->ProductTariffScheme)){
            $this->appendObject($affinity_response->ProductTariffScheme);
        }

        return $this;
    }

    protected function appendObject($affinity_contact){
        $affinity_tariff_object = new AffinityContactObject();

        $affinity_tariff_object->setObject($affinity_contact);

        $this->affinity_contact_objects[] = $affinity_tariff_object;
    }

    public function getResponse(): array
    {
        return $this->affinity_contact_objects;
    }
}