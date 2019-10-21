<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinitySiteObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['site_id'] = null;
        $this->response_array['site_uid'] = null;
        $this->response_array['bsa'] = null;
        $this->response_array['live'] = false;
        $this->response_array['payment_method'] = null;
        $this->response_array['site_name'] = null;
        $this->response_array['site_address'] = null;
        $this->response_array['invoice_address'] = null;
        $this->response_array['site_address_id'] = null;
        $this->response_array['invoice_address_id'] = null;
        $this->response_array['status'] = null;
        $this->response_array['residential_customer'] = null;
        $this->response_array['site_contact_id'] = null;
    }

    public function setObject(\stdClass $affinity_team_response)
    {
        $this->raw_response = $affinity_team_response;

        $this->response_array['site_id'] = $this->integerField($affinity_team_response->SiteID);
        $this->response_array['site_uid'] = $this->stringField($affinity_team_response->SiteUID);
        $this->response_array['bsa'] = $this->stringField($affinity_team_response->BSA);
        $this->response_array['live'] = $this->booleanField($affinity_team_response->Live);
        $this->response_array['payment_method'] = $this->stringField($affinity_team_response->PaymentMethod);
        $this->response_array['site_name'] = $this->stringField($affinity_team_response->SiteName);
        $this->response_array['site_address'] = $this->stringField($affinity_team_response->SiteAddress);
        $this->response_array['site_address_id'] = $this->integerField($affinity_team_response->SiteAddressID);
        $this->response_array['invoice_address'] = $this->stringField($affinity_team_response->InvoiceAddress);
        $this->response_array['invoice_address_id'] = $this->integerField($affinity_team_response->InvoiceAddressID);
        $this->response_array['status'] = $this->stringField($affinity_team_response->Status);
        $this->response_array['residential_customer'] = $this->booleanField($affinity_team_response->ResidentialCustomer);
        $this->response_array['site_contact_id'] = $this->integerField($affinity_team_response->SiteContactID);
    }

    public function getSiteID():? int
    {
        return $this->response_array['site_id'];
    }

    public function getSiteUID(): string
    {
        return $this->response_array['site_uid'];
    }

    public function getBSA():? string
    {
        return $this->response_array['bsa'];
    }

    public function getLive():? bool
    {
        return $this->response_array['live'];
    }

    public function getPaymentMethod():? string
    {
        return $this->response_array['payment_method'];
    }

    public function getSiteName():? string
    {
        return $this->response_array['site_name'];
    }

    public function getSiteAddress():? string
    {
        return $this->response_array['site_address'];
    }

    public function getSiteAddressID():? string
    {
        return $this->response_array['site_address_id'];
    }

    public function getInvoiceAddress():? string
    {
        return $this->response_array['invoice_address'];
    }

    public function getInvoiceAddressID():? int
    {
        return $this->response_array['invoice_address_id'];
    }

    public function getContactID():? int
    {
        return $this->response_array['site_contact_id'];
    }

    public function getResidentialCustomer():? bool
    {
        return $this->response_array['residential_customer'];
    }

    public function getStatus():? string
    {
        return $this->response_array['status'];
    }
}