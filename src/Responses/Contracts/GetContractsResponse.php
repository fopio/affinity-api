<?php namespace Fopio\AffinityAPI\Responses\Contracts;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityContactObject;
use Fopio\AffinityAPI\Objects\AffinityContractObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetContractsResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityContractObject;

    protected $affinity_contract_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_contract_objects = [];

        if(isset($affinity_response->Contracts->Contract)){
            foreach($affinity_response->Contracts->Contract as $affinity_contract){
                $this->appendObject($affinity_contract);
            }
        }elseif(isset($affinity_response->Contract)){
            $this->appendObject($affinity_response->Contract);
        }

        return $this;
    }

    protected function appendObject($affinity_contract){
        $affinity_tariff_object = new AffinityContractObject();

        $affinity_tariff_object->setObject($affinity_contract);

        $this->affinity_contract_objects[] = $affinity_tariff_object;
    }

    public function getResponse(): array
    {
        return $this->affinity_contract_objects;
    }
}