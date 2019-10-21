<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Requests\Tickets\TicketCreateRequest;
use Fopio\AffinityAPI\Requests\Tickets\TicketUpdateRequest;
use Fopio\AffinityAPI\Responses\Tickets\GetTicketResponse;
use Fopio\AffinityAPI\Responses\Tickets\GetTicketsResponse;

/**
 * Class AffinityTicketAPI
 * @package App\Packages\Affinity
 */
class AffinityTicketAPI extends AffinityAPICore
{
    protected $get_ticket_response;

    protected $get_tickets_response;

    public function __construct()
    {
        $this->get_ticket_response = new GetTicketResponse();

        $this->get_tickets_response = new GetTicketsResponse();

        parent::__construct();
    }

    /**
     * Get a ticket based on the ticket id
     * @param int $ticket_id
     * @throws \Exception
     * @return GetTicketResponse
     */
    protected function getTicketByID(int $ticket_id):? GetTicketResponse
    {
        $response = $this->client->XmlGetTicketByID(array('identityToken' => $this->getToken(), 'ticketID' => $ticket_id));

        if ($this->errorResponse($response->XmlGetTicketByIDResult)) throw new \Exception('No ticket result received.' . serialize($response));

        $result = $this->xmlToObject($response->XmlGetTicketByIDResult->Result);

        $this->get_ticket_response->setResponse($result->Ticket);

        return $this->get_ticket_response;
    }


    /**
     * Creates an affinity ticket
     * @param TicketCreateRequest $ticket_create_request
     * @return GetTicketResponse
     * @throws \Exception
     */
    protected function createTicket(TicketCreateRequest $ticket_create_request):? GetTicketResponse
    {
        if (!$ticket_create_request->isValid()) throw new \Exception('Create ticket request not valid. ' . serialize($ticket_create_request->getErrors()));

        $ticket_xml = $this->arrayToXMLString($ticket_create_request->getRequestArray(), 'Ticket');

        $response = $this->client->XmlAddTicket(array('identityToken' => $this->getToken(), 'ticketXml' => $ticket_xml));

        if ($this->errorResponse($response->XmlAddTicketResult)) throw new \Exception('No ticket create result received.' . serialize($response));

        $result = $this->xmlToObject($response->XmlAddTicketResult->Result);

        $this->get_ticket_response->setResponse($result->Ticket);

        return $this->get_ticket_response;
    }

    /**
     * Update a ticket by ID
     * @param int $ticket_id
     * @param TicketUpdateRequest $ticketUpdateRequest
     * @throws \Exception
     * @return GetTicketResponse
     */
    protected function updateTicket(int $ticket_id, TicketUpdateRequest $ticketUpdateRequest):?GetTicketResponse
    {
        if (!$ticketUpdateRequest->isValid()) throw new \Exception('Update ticket request not valid. ' . serialize($ticketUpdateRequest->getErrors()));

        $ticket_xml = $this->arrayToXMLString($ticketUpdateRequest->getRequestArray(), 'Ticket');

        $response = $this->client->XmlUpdateTicketByID(array('identityToken' => $this->getToken(), 'ticketID' => $ticket_id, 'ticketXml' => $ticket_xml));

        if ($this->errorResponse($response->XmlUpdateTicketByIDResult)) throw new \Exception('No ticket update result received.' . serialize($response));

        $result = $this->xmlToObject($response->XmlUpdateTicketByIDResult->Result);

        if(!isset($result->Ticket)) return null;

        $this->get_ticket_response->setResponse($result->Ticket);

        return $this->get_ticket_response;
    }

    /**
     * Get the tickets based on filter
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @return GetTicketsResponse|null
     * @throws \Exception
     */
    protected function getTickets(Filter $filter, int $offset = 0, int $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null):?GetTicketsResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if(!$ordering) $ordering = $this->default_ordering->create()->field('TicketID', 'Asc');

        $response = $this->client->XmlQueryTickets(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlQueryTicketsResult)) throw new \Exception('No tickets result received.' . serialize($response));

        $result = $this->xmlToObject($response->XmlQueryTicketsResult->Result);

        $this->get_tickets_response->setResponse($result);

        return $this->get_tickets_response;
    }


    /**
     * Returns qty of tickets based on query
     * @param Filter $filter
     * @throws \Exception
     * @return int
     */
    protected function getTicketCount(Filter $filter):int
    {
        $response = $this->client->XmlGetTicketCount(array('identityToken' => $this->getToken(), 'filterXml' => $filter->getFilterXML()));

        if ($this->errorResponse($response->XmlGetTicketCountResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetTicketCountResult->Result);

        return (int)$result->TicketCount;
    }

}