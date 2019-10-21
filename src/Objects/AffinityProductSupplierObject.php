<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityProductSupplierObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    use DatesTrait;

    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['product_supplier_id'] = null;
        $this->response_array['product_supplier_uid'] = null;
        $this->response_array['product_id'] = null;
        $this->response_array['supplier_id'] = null;
        $this->response_array['supplier_product_code'] = null;
        $this->response_array['preferred_supplier'] = null;
        $this->response_array['nominal_code_id'] = null;
        $this->response_array['last_edited_date'] = null;
        $this->response_array['enabled'] = null;
    }

    public function setObject(\stdClass $affinity_team_response)
    {
        $this->raw_response = $affinity_team_response;

        $this->response_array['product_supplier_id'] = $this->integerField($affinity_team_response->ProductItemSupplierID);
        $this->response_array['product_supplier_uid'] = $this->stringField($affinity_team_response->ProductItemSupplierUID);
        $this->response_array['product_id'] = $this->integerField($affinity_team_response->ProductItemID);
        $this->response_array['supplier_id'] = $this->integerField($affinity_team_response->SupplierID);
        $this->response_array['supplier_product_code'] = $this->stringField($affinity_team_response->SupplierProductCode);
        $this->response_array['preferred_supplier'] = $this->booleanField($affinity_team_response->PreferredSupplier);
        $this->response_array['nominal_code_id'] = $this->integerField($affinity_team_response->NominalCodeID);
        $this->response_array['last_edited_date'] = $this->carbonDateFromAffinityField($affinity_team_response->LastEdited);
        $this->response_array['enabled'] = $this->booleanField($affinity_team_response->Enabled);
    }

    public function getProductSupplierID():? int
    {
        return $this->response_array['product_supplier_id'];
    }

    public function getProductSupplierUID():? int
    {
        return $this->response_array['product_supplier_uid'];
    }

    public function getProductID():? int
    {
        return $this->response_array['product_id'];
    }

    public function getSupplierID():? int
    {
        return $this->response_array['supplier_id'];
    }

    public function getSupplierProductCode():? string
    {
        return $this->response_array['supplier_product_code'];
    }

    public function getPreferredSupplier():? bool
    {
        return $this->response_array['preferred_supplier'];
    }

    public function getNominalCodeID():? int
    {
        return $this->response_array['nominal_code_id'];
    }

    public function getLastEditedDate():? Carbon
    {
        return $this->response_array['last_edited_date'];
    }

    public function getEnabled():? bool
    {
        return $this->response_array['enabled'];
    }
}