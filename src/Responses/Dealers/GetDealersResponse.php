<?php namespace Fopio\AffinityAPI\Responses\Dealers;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetDealersResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityDealerObject;

    protected $affinity_dealer_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_dealer_objects = [];

        foreach($affinity_response->CLIs->CLI as $affinity_dealer){
            $affinity_dealer_object = new AffinityCLIObject();

            $affinity_dealer_object->setObject($affinity_dealer);

            $this->affinity_dealer_objects[] = $affinity_dealer_object;
        }

        return $this;
    }

    public function getResponse(): array
    {
        return $this->affinity_dealer_objects;
    }
}