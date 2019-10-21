<?php namespace Fopio\AffinityAPI\Objects;

use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityTaskObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    use DatesTrait;

    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['task_id'] = null;
        $this->response_array['task_uid'] = null;
        $this->response_array['summary'] = null;
        $this->response_array['details'] = null;
        $this->response_array['priority'] = null;
        $this->response_array['date_due'] = null;
        $this->response_array['entered_by'] = null;
        $this->response_array['owner_id'] = null;
        $this->response_array['team_id'] = null;
        $this->response_array['category'] = null;
        $this->response_array['sub_category'] = null;
        $this->response_array['status'] = null;
        $this->response_array['connected_to'] = null;
        $this->response_array['connection_type'] = null;
    }

    public function setObject(\stdClass $affinity_task_response)
    {
        $this->raw_response = $affinity_task_response;

        $this->response_array['task_id'] = $this->integerField($affinity_task_response->TaskID);
        $this->response_array['task_uid'] = $this->stringField($affinity_task_response->TaskUID);
        $this->response_array['summary'] = $this->stringField($affinity_task_response->Summary);
        $this->response_array['details'] = $this->stringField($affinity_task_response->Details);
        $this->response_array['priority'] = $this->integerField($affinity_task_response->Priority);
        $this->response_array['date_due'] = $this->carbonDateFromAffinityField($affinity_task_response->DateDue);
        $this->response_array['entered_by'] = $this->integerField($affinity_task_response->EnteredByID);
        $this->response_array['owner_id'] = $this->integerField($affinity_task_response->OwnerID);
        $this->response_array['team_id'] = $this->integerField($affinity_task_response->TeamID);
        $this->response_array['category'] = $this->stringField($affinity_task_response->Category);
        $this->response_array['sub_category'] = $this->stringField($affinity_task_response->SubCategory);
        $this->response_array['status'] = $this->stringField($affinity_task_response->Status);
        $this->response_array['connected_to'] = $this->stringField($affinity_task_response->ConnectedTo);
        $this->response_array['connection_type'] = $this->stringField($affinity_task_response->ConnectionType);
    }

    public function getTaskID():? int
    {
        return $this->response_array['task_id'];
    }

    public function getTaskUID(): string
    {
        return $this->response_array['task_uid'];
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

    public function getConnectedTo():? string
    {
        return $this->response_array['connected_to'];
    }

    public function getConnectionType():? string
    {
        return $this->response_array['connection_type'];
    }
}