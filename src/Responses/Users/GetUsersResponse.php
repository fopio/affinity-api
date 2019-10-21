<?php namespace Fopio\AffinityAPI\Responses\Users;

use Fopio\AffinityAPI\Objects\AffinityTicketObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetUsersResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityUserObject;

    protected $affinity_user_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_user_objects = [];

        foreach($affinity_response->Tickets->Ticket as $affinity_user){
            $affinity_user_object = new AffinityTicketObject();

            $affinity_user_object->setObject($affinity_user);

            $this->affinity_user_objects[] = $affinity_user_object;
        }

        return $this;
    }

    public function getResponse(): array
    {
        return $this->affinity_user_objects;
    }
}