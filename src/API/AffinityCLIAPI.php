<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Responses\CLIs\GetCLIResponse;
use Fopio\AffinityAPI\Responses\CLIs\GetAddressesResponse;
use Fopio\AffinityAPI\Responses\CLIs\GetCLIsResponse;

/**
 * Class AffinitySiteAPI
 * @package App\Packages\Affinity
 */
class AffinityCLIAPI extends AffinityAPICore
{
    protected $get_cli_response;

    protected $get_clis_response;

    public function __construct()
    {
        $this->get_cli_response = new GetCLIResponse();

        $this->get_clis_response = new GetCLIsResponse();

        parent::__construct();
    }

    /**
     * Gets the number of cli based on the filter
     * @param Filter $filter
     * @throws \Exception
     * @return int
     */
    protected function getCLICount(Filter $filter): int
    {
        $response = $this->client->XmlGetCLICount(array('identityToken' => $this->getToken(), 'filterXml' => $filter->getFilterXML()));

        if ($this->errorResponse($response->XmlGetCLICountResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetCLICountResult->Result);

        return $result->CLICount;
    }

    /**
     * Gets a list of CLIs based on filter
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetCLIsResponse
     */
    protected function getCLIs(Filter $filter, $offset = 0, $qty = 30, Projection $projection = null, Ordering $ordering = null):?GetCLIsResponse
    {
        if (!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('CLINumber', 'Asc');

        $response = $this->client->XmlQueryCLIs(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlQueryCLIsResult)) throw new \Exception('No cli result received.' . serialize($response));

        $result = $this->xmlToObject($response->XmlQueryCLIsResult->Result);

        $this->get_clis_response->setResponse($result);

        return $this->get_clis_response;
    }

    /**
     * Gets one CLI based on filter
     * @param Filter $filter
     * @throws \Exception
     * @return GetCLIResponse
     */
    protected function getCLI(Filter $filter):?GetCLIResponse
    {
        $projection = $this->default_projection;

        $ordering = $this->default_ordering->create()->field('CLINumber', 'Asc');

        $response = $this->client->XmlQueryCLIs(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => 0, 'numberOfItemsToTake' => 1, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlQueryCLIsResult)) throw new \Exception('No cli result received.' . serialize($response));

        $result = $this->xmlToObject($response->XmlQueryCLIsResult->Result);

        $this->get_cli_response->setResponse($result->CLI);

        return $this->get_cli_response;
    }
}