<?php namespace Fopio\AffinityAPI\API;
use Fopio\AffinityAPI\Responses\Companies\GetCompaniesResponse;
use Fopio\AffinityAPI\Responses\Companies\GetCompanyResponse;

/**
 * Class AffinityComapnyAPI
 * @package App\Packages\Affinity
 */
class AffinityCompanyAPI extends AffinityAPICore
{
    protected $get_company_response;

    protected $get_companies_response;

    public function __construct()
    {
        $this->get_company_response = new GetCompanyResponse();

        $this->get_companies_response = new GetCompaniesResponse();

        parent::__construct();
    }

    /**
     * Gets a list of Companies based on filter
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetCompaniesResponse
     */
    protected function getCompanies(Filter $filter, $offset = 0, $qty = 30, Projection $projection = null, Ordering $ordering = null):?GetCompaniesResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('companyID', 'Asc');

        $response = $this->client->XmlQueryCompanies(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlQueryCompaniesResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlQueryCompaniesResult->Result);

        $this->get_companies_response->setResponse($result);

        return $this->get_companies_response;
    }

    /**
     * Gets the number of companies based on the filter
     * @param Filter $filter
     * @throws \Exception
     * @return int
     */
    protected function getCompanyCount(Filter $filter):int
    {
        $response = $this->client->XmlGetCompanyCount(array('identityToken' => $this->getToken(), 'filterXml' => $filter->getFilterXML()));

        if ($this->errorResponse($response->XmlGetCompanyCountResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetCompanyCountResult->Result);

        return $result->CompanyCount;
    }

}