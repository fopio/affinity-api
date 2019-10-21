<?php namespace Fopio\AffinityAPI\API;
use Fopio\AffinityAPI\Responses\Dealers\GetDealerResponse;
use Fopio\AffinityAPI\Responses\Dealers\GetDealersResponse;

/**
 * Class AffinityDealerAPI
 * @package App\Packages\Affinity
 */
class AffinityDealerAPI extends AffinityAPICore
{
    protected $get_dealer_response;

    protected $get_dealers_response;

    public function __construct()
    {
        $this->get_dealer_response = new GetDealerResponse();

        $this->get_dealers_response = new GetDealersResponse();

        parent::__construct();
    }

    /**
     * Gets a list of Dealers based on filter - DO NOT HAVE USER PERMISSIONS TO GET DEALER CALLS :(
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetDealersResponse
     */
    protected function getDealers(Filter $filter, $offset = 0, $qty = 30, Projection $projection = null, Ordering $ordering = null):?GetDealersResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('dealerID', 'Asc');

        $response = $this->client->XmlQueryDealers(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlQueryDealersResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlQueryDealersResult->Result);

        $this->get_dealer_response->setResponse($result);

        return $this->get_dealers_response;
    }
}