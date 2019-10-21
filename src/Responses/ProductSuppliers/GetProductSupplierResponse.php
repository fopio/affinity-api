<?php namespace Fopio\AffinityAPI\Responses\ProductSuppliers;

use Fopio\AffinityAPI\Objects\AffinityProductSupplierObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetProductSupplierResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityProductSupplierObject;

    public function __construct()
    {
        $this->affinityProductSupplierObject = new AffinityProductSupplierObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityProductSupplierObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityProductSupplierObject
    {
        return $this->affinityProductSupplierObject;
    }
}