<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityContractObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    use DatesTrait;

    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['contract_id'] = null;
        $this->response_array['contract_uid'] = null;
        $this->response_array['connected_to'] = null;
        $this->response_array['connection_type'] = null;
        $this->response_array['description'] = null;
        $this->response_array['contract_term'] = null;
        $this->response_array['start_date'] = null;
        $this->response_array['end_date'] = null;
        $this->response_array['contract_type'] = null;
        $this->response_array['status'] = null;
        $this->response_array['notice_period'] = null;
        $this->response_array['reference'] = null;
        $this->response_array['termination_date'] = null;
        $this->response_array['signed_date'] = null;
        $this->response_array['last_edited'] = null;
        $this->response_array['notice_received'] = null;
        $this->response_array['notice_given_by'] = null;
    }

    public function setObject(\stdClass $affinity_team_response)
    {
        $this->raw_response = $affinity_team_response;

        $this->response_array['contract_id'] = $this->integerField($affinity_team_response->ContractID);
        $this->response_array['contract_uid'] = $this->integerField($affinity_team_response->ContractUID);
        $this->response_array['connected_to'] = $this->stringField($affinity_team_response->ConnectedTo);
        $this->response_array['connection_type'] = $this->stringField($affinity_team_response->ConnectionType);
        $this->response_array['description'] = $this->stringField($affinity_team_response->Description);
        $this->response_array['contract_term'] = $this->integerField($affinity_team_response->ContractTerm);
        $this->response_array['start_date'] = $this->carbonDateFromAffinityField($affinity_team_response->StartDate);
        $this->response_array['end_date'] = $this->carbonDateFromAffinityField($affinity_team_response->EndDate);
        $this->response_array['contract_type'] = $this->stringField($affinity_team_response->ContractType);
        $this->response_array['status'] = $this->stringField($affinity_team_response->Status);
        $this->response_array['notice_period'] = $this->integerField($affinity_team_response->NoticePeriod);
        $this->response_array['reference'] = $this->stringField($affinity_team_response->Reference);
        $this->response_array['termination_date'] = $this->carbonDateFromAffinityField($affinity_team_response->TerminationDate);
        $this->response_array['signed_date'] = $this->carbonDateFromAffinityField($affinity_team_response->SignedDate);
        $this->response_array['signed_by'] = $this->stringField($affinity_team_response->SignedBy);
        $this->response_array['last_edited'] = $this->carbonDateFromAffinityField($affinity_team_response->LastEdited);
        $this->response_array['notice_received'] = $this->carbonDateFromAffinityField($affinity_team_response->NoticeReceived);
        $this->response_array['notice_given_by'] = $this->stringField($affinity_team_response->NoticeGivenBy);
    }

    public function getContractID():? int
    {
        return $this->response_array['contract_id'];
    }

    public function getContractUID():? string
    {
        return $this->response_array['contract_uid'];
    }

    public function getConnectedTo():? string
    {
        return $this->response_array['connected_to'];
    }

    public function getConnectionType():? string
    {
        return $this->response_array['connection_type'];
    }

    public function getDescription():? string
    {
        return $this->response_array['description'];
    }

    public function getContractTerm():? int
    {
        return $this->response_array['contract_term'];
    }

    public function getStartDate():? Carbon
    {
        return $this->response_array['start_date'];
    }

    public function getEndDate():? Carbon
    {
        return $this->response_array['end_date'];
    }

    public function getContractType():? string
    {
        return $this->response_array['contract_type'];
    }

    public function getStatus():? string
    {
        return $this->response_array['status'];
    }

    public function getNoticePeriod():? int
    {
        return $this->response_array['notice_period'];
    }

    public function getReference():? string
    {
        return $this->response_array['reference'];
    }

    public function getTerminationDate():? Carbon
    {
        return $this->response_array['termination_date'];
    }

    public function getSignedDate():? Carbon
    {
        return $this->response_array['signed_date'];
    }

    public function getSignedBy():? string
    {
        return $this->response_array['signed_by'];
    }

    public function getLastEdited():? Carbon
    {
        return $this->response_array['last_edited'];
    }

    public function getNoticeReceived():? Carbon
    {
        return $this->response_array['notice_received'];
    }

    public function getNoticeGivenBy():? string
    {
        return $this->response_array['notice_given_by'];
    }

}