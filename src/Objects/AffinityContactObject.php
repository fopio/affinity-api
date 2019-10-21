<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityContactObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    use DatesTrait;

    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['contact_id'] = null;
        $this->response_array['contact_uid'] = null;
        $this->response_array['title'] = null;
        $this->response_array['first_name'] = null;
        $this->response_array['middle_name'] = null;
        $this->response_array['last_name'] = null;
        $this->response_array['email_address'] = null;
        $this->response_array['work_phone'] = null;
        $this->response_array['fax'] = null;
        $this->response_array['mobile'] = null;
        $this->response_array['DDI'] = null;
        $this->response_array['date_entered'] = null;
        $this->response_array['entered_by_id'] = null;
        $this->response_array['address_id'] = null;
        $this->response_array['status'] = null;
        $this->response_array['contact_address'] = null;
        $this->response_array['contact_type'] = null;
    }

    public function setObject(\stdClass $affinity_team_response)
    {
        $this->raw_response = $affinity_team_response;

        $this->response_array['contact_id'] = $this->integerField($affinity_team_response->ContactID);
        $this->response_array['contact_uid'] = $this->stringField($affinity_team_response->ContactUID);
        $this->response_array['title'] = $this->stringField($affinity_team_response->Title);
        $this->response_array['first_name'] = $this->stringField($affinity_team_response->FirstName);
        $this->response_array['middle_name'] = $this->stringField($affinity_team_response->MiddleName);
        $this->response_array['last_name'] = $this->stringField($affinity_team_response->LastName);
        $this->response_array['email_address'] = $this->stringField($affinity_team_response->EmailAddress);
        $this->response_array['work_phone'] = $this->stringField($affinity_team_response->WorkPhone);
        $this->response_array['fax'] = $this->stringField($affinity_team_response->Fax);
        $this->response_array['mobile'] = $this->stringField($affinity_team_response->Mobile);
        $this->response_array['DDI'] = $this->stringField($affinity_team_response->DDI);
        $this->response_array['date_entered'] = $this->carbonDateFromAffinityField($affinity_team_response->DateEntered);
        $this->response_array['entered_by_id'] = $this->integerField($affinity_team_response->EnteredByID);
        $this->response_array['address_id'] = $this->integerField($affinity_team_response->AddressID);
        $this->response_array['status'] = $this->stringField($affinity_team_response->Status);
        $this->response_array['contact_address'] = $this->stringField($affinity_team_response->ContactAddress);
        $this->response_array['contact_type'] = $this->stringField($affinity_team_response->ContactType);
    }

    public function getContactID():? int
    {
        return $this->response_array['contact_id'];
    }

    public function getContactUID():? int
    {
        return $this->response_array['contact_uid'];
    }

    public function getTitle():? string
    {
        return $this->response_array['title'];
    }

    public function getFirstName():? string
    {
        return $this->response_array['first_name'];
    }

    public function getMiddleName():? string
    {
        return $this->response_array['middle_name'];
    }

    public function getLastName():? string
    {
        return $this->response_array['last_name'];
    }

    public function getEmailAddress():? string
    {
        return $this->response_array['email_address'];
    }

    public function getWorkPhone():? string
    {
        return $this->response_array['work_phone'];
    }

    public function getFax():? string
    {
        return $this->response_array['fax'];
    }

    public function getMobile():? string
    {
        return $this->response_array['mobile'];
    }

    public function getDDI():? string
    {
        return $this->response_array['DDI'];
    }

    public function getDateEntered():? Carbon
    {
        return $this->response_array['date_entered'];
    }

    public function getEnteredByID():? int
    {
        return $this->response_array['entered_by_id'];
    }

    public function getAddressID():? int
    {
        return $this->response_array['address_id'];
    }

    public function getStatus():? string
    {
        return $this->response_array['status'];
    }

    public function getContactAddress():? string
    {
        return $this->response_array['contact_address'];
    }

    public function getContactType():? string
    {
        return $this->response_array['contact_type'];
    }
}