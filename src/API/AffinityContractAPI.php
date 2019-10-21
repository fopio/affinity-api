<?php namespace Fopio\AffinityAPI\API;
use Fopio\AffinityAPI\Responses\Contracts\GetContractsResponse;
use Fopio\AffinityAPI\Responses\Contracts\GetContractResponse;

/**
 * Class AffinitySiteAPI
 * @package App\Packages\Affinity
 */
class AffinityContractAPI extends AffinityAPICore
{
    protected $get_contract_response;

    protected $get_contracts_response;

    public function __construct()
    {
        $this->get_contract_response = new GetContractResponse();

        $this->get_contracts_response = new GetContractsResponse();

        parent::__construct();
    }

    /**
     * Gets a list of Sites based on filter
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetContactsResponse
     */
    protected function getContracts(Filter $filter, $offset = 0, $qty = 30, Projection $projection = null, Ordering $ordering = null):?GetContractsResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('ContractID', 'Asc');

        $response = $this->client->XmlQueryContract(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlQueryContractResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlQueryContractResult->Result);

        $this->get_contracts_response->setResponse($result);

        return $this->get_contracts_response;
    }


    /**
     * Gets the number of users based on the filter
     * @param Filter $filter
     * @throws \Exception
     * @return int
     */
    protected function getContractsCount(Filter $filter):int
    {
        $response = $this->client->XmlGetContractCount(array('identityToken' => $this->getToken(), 'filterXml' => $filter->getFilterXML()));

        if ($this->errorResponse($response->XmlGetContractCountResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetContractCountResult->Result);

        return $result->ContractCount;
    }

}