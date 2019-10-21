<?php namespace Fopio\AffinityAPI\Responses\CLIs;

use Fopio\AffinityAPI\Objects\AffinityAddressObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetAddressesResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTicketObject;

    protected $affinity_address_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_address_objects = [];

        foreach($affinity_response->CLIs->CLI as $affinity_address){
            $affinity_cli_object = new AffinityAddressObject();

            $affinity_cli_object->setObject($affinity_address);

            $this->affinity_address_objects[] = $affinity_cli_object;
        }

        return $this;
    }

    public function getResponse(): array
    {
        return $this->affinity_address_objects;
    }
}