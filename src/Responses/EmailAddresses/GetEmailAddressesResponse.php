<?php namespace Fopio\AffinityAPI\Responses\EmailAddresses;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityEmailAddressObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetEmailAddressesResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityEmailAddressObject;

    protected $affinity_email_address_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_email_address_objects = [];

        foreach($affinity_response->CLIs->CLI as $affinity_email_address){
            $affinity_email_address_object = new AffinityEmailAddressObject();

            $affinity_email_address_object->setObject($affinity_email_address);

            $this->affinity_email_address_objects[] = $affinity_email_address_object;
        }

        return $this;
    }

    public function getResponse(): array
    {
        return $this->affinity_email_address_objects;
    }
}