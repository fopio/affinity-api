<?php namespace Fopio\AffinityAPI\Responses\Tickets;

use Fopio\AffinityAPI\Objects\AffinityTicketObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetTicketResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTicketObject;

    public function __construct()
    {
        $this->affinityTicketObject = new AffinityTicketObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityTicketObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityTicketObject
    {
        return $this->affinityTicketObject;
    }
}