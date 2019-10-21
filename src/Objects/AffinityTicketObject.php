<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityTicketObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    use DatesTrait;

    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['ticket_id'] = null;
        $this->response_array['ticket_uid'] = null;
        $this->response_array['summary'] = null;
        $this->response_array['details'] = null;
        $this->response_array['priority'] = null;
        $this->response_array['date_due'] = null;
        $this->response_array['entered_by_id'] = null;
        $this->response_array['owner_id'] = null;
        $this->response_array['team_id'] = null;
        $this->response_array['category'] = null;
        $this->response_array['sub_category'] = null;
        $this->response_array['status'] = null;
        $this->response_array['connected_to'] = null;
        $this->response_array['connection_type'] = null;
        $this->response_array['user_fields'] = [];
    }

    public function setObject(\stdClass $affinity_ticket_response)
    {
        $this->raw_response = $affinity_ticket_response;

        $this->response_array['ticket_id'] = $this->integerField($affinity_ticket_response->TicketID);
        $this->response_array['ticket_uid'] = $this->stringField($affinity_ticket_response->TicketUID);
        $this->response_array['summary'] = $this->stringField($affinity_ticket_response->Summary);
        $this->response_array['details'] = $this->stringField($affinity_ticket_response->Details);
        $this->response_array['priority'] = $this->integerField($affinity_ticket_response->Priority);
        $this->response_array['date_due'] = $this->carbonDateFromAffinityField($affinity_ticket_response->DateDue);
        $this->response_array['entered_by_id'] = $this->integerField($affinity_ticket_response->EnteredByID);
        $this->response_array['owner_id'] = $this->integerField($affinity_ticket_response->OwnerID);
        $this->response_array['team_id'] = $this->integerField($affinity_ticket_response->TeamID);
        $this->response_array['category'] = $this->stringField($affinity_ticket_response->Category);
        $this->response_array['sub_category'] = $this->stringField($affinity_ticket_response->SubCategory);
        $this->response_array['status'] = $this->stringField($affinity_ticket_response->Status);
        $this->response_array['date_created'] = $this->carbonDateFromAffinityField($affinity_ticket_response->DateCreated);
        $this->response_array['connected_to'] = $this->stringField($affinity_ticket_response->ConnectedTo);
        $this->response_array['connection_type'] = $this->stringField($affinity_ticket_response->ConnectionType);

        foreach ((array)$affinity_ticket_response->UserFields as $UserField => $value){
            $this->response_array['user_fields'][$UserField] = $this->stringField($value);
        }
    }

    public function getTicketID():? int
    {
        return $this->response_array['ticket_id'];
    }

    public function getTicketUID(): string
    {
        return $this->response_array['ticket_uid'];
    }

    public function getSummary():? string
    {
        return $this->response_array['summary'];
    }

    public function getDetails():? string
    {
        return $this->response_array['details'];
    }

    public function getPriority():? int
    {
        return $this->response_array['priority'];
    }

    public function getDateDue():? int
    {
        return $this->response_array['date_due'];
    }

    public function getEnteredByID():? int
    {
        return $this->response_array['entered_by_id'];
    }

    public function getOwnerID():? int
    {
        return $this->response_array['owner_id'];
    }

    public function getTeamID(): int
    {
        return $this->response_array['team_id'];
    }

    public function getCategory():? string
    {
        return $this->response_array['category'];
    }

    public function getSubCategory():? string
    {
        return $this->response_array['sub_category'];
    }

    public function getStatus():? string
    {
        return $this->response_array['status'];
    }

    public function getDateCreated():? string
    {
        return $this->response_array['date_created'];
    }

    public function getConnectedTo():? string
    {
        return $this->response_array['connected_to'];
    }

    public function getConnectionType():? string
    {
        return $this->response_array['connection_type'];
    }

    public function getUserField(string $user_field):? string
    {
        return $this->response_array['user_fields'][$user_field];
    }
}