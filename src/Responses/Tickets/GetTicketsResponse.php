<?php namespace Fopio\AffinityAPI\Responses\Tickets;

use Fopio\AffinityAPI\Objects\AffinityTicketObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetTicketsResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTicketObject;

    protected $affinity_ticket_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_ticket_objects = [];

        foreach($affinity_response->Tickets->Ticket as $affinity_ticket){
            $affinity_ticket_object = new AffinityTicketObject();

            $affinity_ticket_object->setObject($affinity_ticket);

            $this->affinity_ticket_objects[] = $affinity_ticket_object;
        }

        return $this;
    }

    public function getResponse(): array
    {
        return $this->affinity_ticket_objects;
    }
}