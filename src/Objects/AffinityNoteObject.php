<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityNoteObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    use DatesTrait;

    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['note_id'] = null;
        $this->response_array['note_uid'] = null;
        $this->response_array['summary'] = null;
        $this->response_array['category'] = null;
        $this->response_array['sub_category'] = null;
        $this->response_array['note'] = null;
        $this->response_array['entered_by_id'] = null;
        $this->response_array['connected_to'] = null;
        $this->response_array['connection_type'] = null;
        $this->response_array['date_entered'] = null;
    }

    public function setObject(\stdClass $affinity_team_response)
    {
        $this->raw_response = $affinity_team_response;

        $this->response_array['note_id'] = $this->integerField($affinity_team_response->NoteId);
        $this->response_array['note_uid'] = $this->stringField($affinity_team_response->NoteUID);
        $this->response_array['summary'] = $this->stringField($affinity_team_response->Summary);
        $this->response_array['category'] = $this->stringField($affinity_team_response->Category);
        $this->response_array['sub_category'] = $this->stringField($affinity_team_response->SubCategory);
        $this->response_array['note'] = $this->stringField($affinity_team_response->Note);
        $this->response_array['entered_by_id'] = $this->integerField($affinity_team_response->EnteredByID);
        $this->response_array['connected_to'] = $this->stringField($affinity_team_response->ConnectedTo);
        $this->response_array['connection_type'] = $this->stringField($affinity_team_response->ConnectionType);
        $this->response_array['date_entered'] = $this->carbonDateFromAffinityField($affinity_team_response->DateEntered);
    }

    public function getNoteID():? int
    {
        return $this->response_array['note_id'];
    }

    public function getNoteUID():? string
    {
        return $this->response_array['note_uid'];
    }

    public function getSummary():? string
    {
        return $this->response_array['summary'];
    }

    public function getCategory():? string
    {
        return $this->response_array['category'];
    }

    public function getSubCategory():? string
    {
        return $this->response_array['sub_category'];
    }

    public function getNote():? string
    {
        return $this->response_array['note'];
    }

    public function getEnteredByID():? int
    {
        return $this->response_array['entered_by_id'];
    }

    public function getConnectedTo():? string
    {
        return $this->response_array['connected_to'];
    }

    public function getConnectionType():? string
    {
        return $this->response_array['connection_type'];
    }

    public function getDateEntered():? Carbon
    {
        return $this->response_array['date_entered'];
    }
}