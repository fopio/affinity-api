<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Requests\Products\ProductInstanceCreateRequest;
use Fopio\AffinityAPI\Requests\Products\ProductInstanceUpdateRequest;
use Fopio\AffinityAPI\Responses\Products\GetProductResponse;
use Fopio\AffinityAPI\Responses\Products\GetProductsResponse;

/**
 * Class AffinityProductAPI
 * @package App\Packages\Affinity
 */
class AffinityProductAPI extends AffinityAPICore
{
    protected $get_product_response;

    protected $get_products_response;

    public function __construct()
    {
        $this->get_product_response = new GetProductResponse();

        $this->get_products_response = new GetProductsResponse();

        parent::__construct();
    }

    /**
     * @param int $product_id
     * @return GetProductResponse|null
     * @throws \Exception
     */
    protected function getProductByID(int $product_id):?GetProductResponse
    {
        $response = $this->client->XmlGetProductItemByID(array('identityToken' => $this->getToken(), 'productItemID' => $product_id));

        if ($this->errorResponse($response->XmlGetProductItemByIDResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetProductItemByIDResult->Result);

        $this->get_product_response->setResponse($result->AffinityTeam);

        return $this->get_product_response;
    }

    /**
     * @param int $product_id
     * @return GetProductsResponse|null
     * @throws \Exception
     * @return GetProductResponse
     */
    protected function getProductItemCategoryByID(int $product_id):?GetProductResponse
    {
        $response = $this->client->XmlGetProductItemCategoryByID(array('identityToken' => $this->getToken(), 'productItemID' => $product_id));

        if ($this->errorResponse($response->XmlGetProductItemCategoryByIDResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetProductItemCategoryByIDResult->Result);

        $this->get_product_response->setResponse($result->AffinityTeam);

        return $this->get_product_response;
    }

    /**
     * @param int $product_id
     * @return GetProductResponse|null
     * @throws \Exception
     */
    protected function getProductTariffSchemeByID(int $product_id):?GetProductResponse
    {
        $response = $this->client->XmlGetProductTariffSchemeByID(array('identityToken' => $this->getToken(), 'productItemID' => $product_id));

        if ($this->errorResponse($response->XmlGetProductTariffSchemeByIDResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetProductTariffSchemeByIDResult->Result);

        $this->get_product_response->setResponse($result->AffinityTeam);

        return $this->get_product_response;
    }

    /**
     * Get list of product Categories
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return object
     */
    protected function getProductCategories(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null)
    {
        if (!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('CategoryID', 'Asc');

        $response = $this->client->XmlQueryProductItemCategories(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlQueryProductItemCategoriesResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlQueryProductItemCategoriesResult->Result);

        $this->get_products_response->setResponse($result);

        return $this->get_products_response;
    }

    /**
     * Get list of products
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return object
     */
    protected function getProductItems(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null, $product_type = null)
    {
        if (!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('ProductItemID', 'Asc');

        $response = $this->client->XmlQueryProductItems(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML(), 'productType' => $product_type));

        if ($this->errorResponse($response->XmlQueryProductItemsResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlQueryProductItemsResult->Result);

        $this->get_products_response->setResponse($result);

        return $this->get_products_response;
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
    protected function getProductItemCount(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null, $product_type = null)
    {
        if (!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('ProductItemID', 'Asc');

        $response = $this->client->XmlGetProductItemCount(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML(), 'productType' => $product_type));

        if ($this->errorResponse($response->XmlGetProductItemCountResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetProductItemCountResult->Result);

        return (int)$result->ProductItemCount;
    }


    /**
     * Get Category Count
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return int
     */
    protected function getCategoryCount(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null)
    {
        if (!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('CategoryID', 'Asc');

        $response = $this->client->XmlGetProductItemCategoryCount(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlGetProductItemCategoryCountResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetProductItemCategoryCountResult->Result);

        return (int)$result->ProductItemCategoryCount;
    }


    /**
     * Get list of product instances
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return object
     */
    protected function getProducts(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null, $product_type = null)
    {
        if (!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('ProductInstanceID', 'Asc');

        $response = $this->client->XmlQueryProducts(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML(), 'productType' => $product_type));

        if ($this->errorResponse($response->XmlQueryProductsResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlQueryProductsResult->Result);

        $this->get_product_response->setResponse($result);

        return $this->get_product_response;
    }

    /**
     * Get list of product instances
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return object
     */
    protected function getProductInstances(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null, $product_type = null)
    {
        if (!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('SiteID', 'Asc');

        $response = $this->client->XmlQuerySiteProductItems(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML(), 'productType' => $product_type));

        if ($this->errorResponse($response->XmlQuerySiteProductItemsResult)) throw new \Exception('Affinity missing results');

        return $this->xmlToObject($response->XmlQuerySiteProductItemsResult->Result);
    }

    /**
     * @param ProductInstanceCreateRequest $productInstanceCreateRequest
     * @throws \Exception
     * @return object
     */
    protected function createProductInstance(ProductInstanceCreateRequest $productInstanceCreateRequest)
    {
        $product_xml = $this->arrayToXMLString($productInstanceCreateRequest->getRequestArray(), 'SiteProductItem');

        $response = $this->client->XmlAddSiteProductItem(array('identityToken' => $this->getToken(),
            'siteProductItemXml' => $product_xml));

        if ($this->errorResponse($response->XmlAddSiteProductItemResult)) throw new \Exception('Affinity missing results');

        return $this->xmlToObject($response->XmlAddSiteProductItemResult->Result);
    }

    /**
     * @param int $product_instance_id
     * @param ProductInstanceUpdateRequest $productInstanceUpdateRequest
     * @throws \Exception
     * @return object
     */
    protected function updateProductInstance(int $product_instance_id, ProductInstanceUpdateRequest $productInstanceUpdateRequest)
    {
        $product_xml = $this->arrayToXMLString($productInstanceUpdateRequest->getRequestArray(), 'SiteProductItem');

        $response = $this->client->XmlUpdateSiteProductItemByID(array('identityToken' => $this->getToken(),
            'siteProductItemID' => $product_instance_id,
            'siteProductItemXml' => $product_xml));

        if ($this->errorResponse($response->XmlUpdateSiteProductItemByIDResult)) throw new \Exception('Affinity missing results');

        return $this->xmlToObject($response->XmlUpdateSiteProductItemByIDResult->Result);
    }
}