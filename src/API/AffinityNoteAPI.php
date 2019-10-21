<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Requests\Notes\SiteNoteCreateRequest;
use Fopio\AffinityAPI\Requests\Notes\TaskNoteCreateRequest;
use Fopio\AffinityAPI\Requests\Notes\TicketNoteCreateRequest;
use Fopio\AffinityAPI\Responses\Notes\GetNoteResponse;
use Fopio\AffinityAPI\Responses\Notes\GetNotesResponse;

/**
 * Class AffinityNoteAPI
 * @package App\Packages\Affinity
 */
class AffinityNoteAPI extends AffinityAPICore
{
    protected $get_note_response;

    protected $get_notes_response;

    public function __construct()
    {
        $this->get_note_response = new GetNoteResponse();

        $this->get_notes_response = new GetNotesResponse();

        parent::__construct();
    }


    /**
     * Creates a task note
     * @param TaskNoteCreateRequest $taskNoteCreateRequest
     * @throws \Exception
     * @return int
     */
    protected function createTaskNote(TaskNoteCreateRequest $taskNoteCreateRequest):int
    {
        $response = $this->client->CreateNewNoteOnTaskByID(array('IdentityToken' => $this->getToken(),
            'summary' => $taskNoteCreateRequest->getSummary(),
            'task' => $taskNoteCreateRequest->getTaskID(),
            'detail' => $taskNoteCreateRequest->getDetails(),
            'category' => $taskNoteCreateRequest->getCategory()));

        if ($this->errorResponse($response->CreateNewNoteOnTaskByIDResult)) throw new \Exception('Affinity missing results');

        return $response->noteID;
    }

    /**
     * Creates a ticket note
     * @param TicketNoteCreateRequest $ticketNoteCreateRequest
     * @throws \Exception
     * @return int
     */
    protected function createTicketNote(TicketNoteCreateRequest $ticketNoteCreateRequest):int
    {
        $response = $this->client->CreateNewNoteOnTicketByID(array('IdentityToken' => $this->getToken(),
            'summary' => $ticketNoteCreateRequest->getSummary(),
            'ticket' => $ticketNoteCreateRequest->getTicketID(),
            'detail' => $ticketNoteCreateRequest->getDetails(),
            'category' => $ticketNoteCreateRequest->getCategory()));

        if ($this->errorResponse($response->CreateNewNoteOnTicketByIDResult)) throw new \Exception('Affinity missing results');

        return $response->noteID;
    }

    /**
     * Creates a note on the site based on ID
     * @param SiteNoteCreateRequest $siteNoteCreateRequest
     * @throws \Exception
     * @return int The note ID
     */
    protected function CreateSiteNote(SiteNoteCreateRequest $siteNoteCreateRequest):int
    {
        $response = $this->client->CreateNewNoteOnSiteByID(array('IdentityToken' => $this->getToken(),
            'summary' => $siteNoteCreateRequest->getSummary(),
            'siteID' => $siteNoteCreateRequest->getSiteID(),
            'detail' => $siteNoteCreateRequest->getDetails(),
            'category' => $siteNoteCreateRequest->getCategory()));

        if ($this->errorResponse($response->CreateNewNoteOnSiteByIDResult)) throw new \Exception('Affinity missing results');

        return $response->noteID;
    }

    /**
     * @param int $note_id
     * @return GetNoteResponse|null
     * @throws \Exception
     */
    protected function getNoteByID(int $note_id):?GetNoteResponse
    {
        $response = $this->client->XmlGetNoteByID(array('identityToken' => $this->getToken(), 'noteID' => $note_id));

        if ($this->errorResponse($response->XmlGetNoteByIDResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetNoteByIDResult->Result);

        $this->get_note_response->setResponse($result->Note);

        return $this->get_note_response;
    }

    /**
     * Gets selection of notes based on query
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetNotesResponse
     */
    protected function getNotes(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null):?GetNotesResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('NoteId', 'Asc');

        $response = $this->client->XmlQueryNotes(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlQueryNotesResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlQueryNotesResult->Result);

        $this->get_notes_response->setResponse($result);

        return $this->get_notes_response;
    }


    /**
     * Returns qty of notes based on query
     * @param Filter $filter
     * @throws \Exception
     * @return int
     */
    protected function getNoteCount(Filter $filter):int
    {
        $response = $this->client->XmlGetNoteCount(array('identityToken' => $this->getToken(), 'filterXml' => $filter->getFilterXML()));

        if ($this->errorResponse($response->XmlGetNoteCountResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetNoteCountResult->Result);

        return $result->NoteCount;
    }

}