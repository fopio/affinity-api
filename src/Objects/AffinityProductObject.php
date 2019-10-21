<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityProductObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    use DatesTrait;

    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['product_id'] = null;
        $this->response_array['product_uid'] = null;
        $this->response_array['product_code'] = null;
        $this->response_array['description'] = null;
        $this->response_array['bill_description'] = null;
        $this->response_array['billing_frequency_id'] = null;
        $this->response_array['product_category_id'] = null;
        $this->response_array['nominal_code_id'] = null;
        $this->response_array['start_date'] = null;
        $this->response_array['end_date'] = null;
        $this->response_array['last_edited_date'] = null;
        $this->response_array['enabled'] = null;
        $this->response_array['date_entered'] = null;
    }

    public function setObject(\stdClass $affinity_response)
    {
        $this->raw_response = $affinity_response;

        $this->response_array['product_id'] = $this->integerField($affinity_response->ProductItemID);
        $this->response_array['product_uid'] = $this->stringField($affinity_response->ProductItemUID);
        $this->response_array['product_code'] = $this->stringField($affinity_response->ProductCode);
        $this->response_array['description'] = $this->stringField($affinity_response->Description);
        $this->response_array['bill_description'] = $this->stringField($affinity_response->BillDescription);
        $this->response_array['billing_frequency_id'] = $this->integerField($affinity_response->BillingFrequencyID);
        $this->response_array['product_category_id'] = $this->integerField($affinity_response->ProductItemCategoryID);
        $this->response_array['nominal_code_id'] = $this->integerField($affinity_response->NominalCodeID);
        $this->response_array['start_date'] = $this->carbonDateFromAffinityField($affinity_response->StartDate);
        $this->response_array['end_date'] = $this->carbonDateFromAffinityField($affinity_response->EndDate);
        $this->response_array['last_edited_date'] = $this->carbonDateFromAffinityField($affinity_response->LastEdited);
        $this->response_array['enabled'] = $this->booleanField($affinity_response->Enabled);
        $this->response_array['date_entered'] = $this->carbonDateFromAffinityField($affinity_response->DateEntered);
    }

    public function getProductID():? int
    {
        return $this->response_array['product_id'];
    }

    public function getProductUID():? int
    {
        return $this->response_array['product_uid'];
    }

    public function getProductCode():? string
    {
        return $this->response_array['product_code'];
    }

    public function getDescription():? string
    {
        return $this->response_array['description'];
    }

    public function getBillDescription():? string
    {
        return $this->response_array['bill_description'];
    }

    public function getBillingFrequencyID():? int
    {
        return $this->response_array['billing_frequency_id'];
    }

    public function getProductCategoryID():? int
    {
        return $this->response_array['product_category_id'];
    }

    public function getNominalCodeID():? int
    {
        return $this->response_array['nominal_code_id'];
    }

    public function getStartDate():? Carbon
    {
        return $this->response_array['start_date'];
    }

    public function getEndDate():? Carbon
    {
        return $this->response_array['end_date'];
    }

    public function getLastEditedDate():? Carbon
    {
        return $this->response_array['last_edited_date'];
    }

    public function getEnabled():? bool
    {
        return $this->response_array['enabled'];
    }

    public function getDateEntered():? Carbon
    {
        return $this->response_array['date_entered'];
    }
}