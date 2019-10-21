<?php namespace Fopio\AffinityAPI\API;
use Fopio\AffinityAPI\Responses\ProductSuppliers\GetProductSupplierResponse;
use Fopio\AffinityAPI\Responses\ProductSuppliers\GetProductSuppliersResponse;

/**
 * Class AffinityProductAPI
 * @package App\Packages\Affinity
 */
class AffinityProductSuppliersAPI extends AffinityAPICore
{
    protected $get_product_supplier_response;

    protected $get_product_suppliers_response;

    public function __construct()
    {
        $this->get_product_supplier_response = new GetProductSupplierResponse();

        $this->get_product_suppliers_response = new GetProductSuppliersResponse();

        parent::__construct();
    }

    /**
     * Get list of products
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetProductSuppliersResponse
     */
    protected function getProductSuppliers(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null):?GetProductSuppliersResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('ProductItemSupplierID', 'Asc');

        $response = $this->client->XmlQueryProductItemSuppliers(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if($this->errorResponse($response->XmlQueryProductItemSuppliersResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlQueryProductItemSuppliersResult->Result);

        $this->get_product_suppliers_response->setResponse($result);

        return $this->get_product_suppliers_response;
    }

    /**
     * Get list of products
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return int
     */
    protected function getProductSuppliersCount(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null):int
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('ProductItemSupplierID', 'Asc');

        $response = $this->client->XmlGetProductItemSupplierCount(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML(), 'productType' => $product_type));

        if($this->errorResponse($response->XmlGetProductItemSupplierCountResult)) throw new \Exception('Affinity missing results');

        $result =  $this->xmlToObject($response->XmlGetProductItemSupplierCountResult->Result);

        return (int)$result->ProductItemSupplierCount;
    }

    /**
     * Get product supplier account ID by supplier ID
     * @param int $supplier_id
     * @return mixed
     */
    protected function getProductSupplierAccountBySupplierID(int $supplier_id):int
    {
        $response = $this->client->GetSupplierAccountsBySupplierID(array('IdentityToken' => $this->getToken(), 'supplierID' => (int)$supplier_id));

        $result = strstr($response->supplierAccountsList->any, '<SupplierAccountID>');

        $result = substr($result, 0, strpos($result, "</SupplierAccounts>"));

        $result = str_replace('<SupplierAccountID>', '', $result);

        $result = str_replace('</SupplierAccountID>', '', $result);

        return (int)$result;
    }
}