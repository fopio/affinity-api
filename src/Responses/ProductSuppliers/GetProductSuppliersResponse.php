<?php namespace Fopio\AffinityAPI\Responses\ProductSuppliers;

use Fopio\AffinityAPI\Objects\AffinityProductSupplierObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetProductSuppliersResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityProductSupplierObject;

    protected $affinity_product_supplier_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_product_supplier_objects = [];

        if(isset($affinity_response->ProductItemSuppliers->ProductItemSupplier)){
            foreach($affinity_response->ProductItemSuppliers->ProductItemSupplier as $affinity_product_supplier){
                $this->appendObject($affinity_product_supplier);
            }
        }elseif(isset($affinity_response->ProductItemSupplier)){
            $this->appendObject($affinity_response->ProductItemSupplier);
        }

        return $this;
    }

    protected function appendObject($affinity_product_supplier){
        $affinity_tariff_object = new AffinityProductSupplierObject();

        $affinity_tariff_object->setObject($affinity_product_supplier);

        $this->affinity_product_supplier_objects[] = $affinity_tariff_object;
    }

    public function getResponse(): array
    {
        return $this->affinity_product_supplier_objects;
    }
}