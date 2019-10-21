<?php namespace Fopio\AffinityAPI\API;
use Fopio\AffinityAPI\Responses\SubSites\GetSubSiteResponse;
use Fopio\AffinityAPI\Responses\SubSites\GetSubSitesResponse;

/**
 * Class AffinitySiteAPI
 * @package App\Packages\Affinity
 */
class AffinitySubSiteAPI extends AffinityAPICore
{
    protected $get_subsite_response;

    protected $get_subsites_response;

    public function __construct()
    {
        $this->get_subsite_response = new GetSubSiteResponse();

        $this->get_subsites_response = new GetSubSitesResponse();

        parent::__construct();
    }

    /**
     * Gets the number of sites based on the filter
     * @param Filter $filter
     * @return int
     */
    protected function getSubSiteCount(Filter $filter): int
    {
        $response = $this->client->XmlGetSubSiteCount(array('identityToken' => $this->getToken(), 'filter' => $filter->getFilterXML()));

        if ($this->errorResponse($response->XmlGetSubSiteCountResult)) throw new \Exception('No subsite count');

        $result = $this->xmlToObject($response->XmlGetSubSiteCountResult->Result);

        return $result->SubSiteCount;
    }

    /**
     * Gets the Sub Site information based on site ID
     * @param int $sub_site_id
     * @throws \Exception
     * @return GetSubSitesResponse
     */
    protected function getSubSiteByID(int $sub_site_id):?GetSubSiteResponse
    {
        $response = $this->client->XmlGetSubSiteById(array('identityToken' => $this->getToken(), 'subSiteID' => $sub_site_id));

        if ($this->errorResponse($response->XmlGetSubSiteByIDResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetSubSiteByIDResult->Result);

        $this->get_subsite_response->setResponse($result->SubSite);

        return $this->get_subsite_response;
    }


    /**
     * Gets the Sub Site Address based on SubSiteID
     * @param $sub_site_id
     * @return object
     */
    protected function GetSubSiteAddressByID($sub_site_id)
    {
        try {
            $response = $this->client->GetSubSiteAddressByID(new \SoapVar('<ns1:GetSubSiteAddressByID>', XSD_ANYXML), new \SoapVar('<ns1:IdentityToken>' . $this->getToken() . '</ns1:IdentityToken>', XSD_ANYXML), new \SoapVar('<ns1:subSiteID>' . $sub_site_id . '</ns1:subSiteID>', XSD_ANYXML), new \SoapVar('</ns1:GetSubSiteAddressByID>', XSD_ANYXML));
        } catch (\Exception $e) {
            dd($e);
        }

        return $response;
    }


    /**
     * Gets the Sub Site ID based on ref code
     * @param string $sub_site_ref
     * @return object
     */
    protected function getSubSiteByRef(string $sub_site_ref):int
    {
        try {
            $response = $this->client->GetSubSiteIDByRef(new \SoapVar('<ns1:GetSiteIDByRef>', XSD_ANYXML), new \SoapVar('<ns1:IdentityToken>' . $this->getToken() . '</ns1:IdentityToken>', XSD_ANYXML), new \SoapVar('<ns1:siteRef>' . $sub_site_ref . '</ns1:siteRef>', XSD_ANYXML), new \SoapVar('</ns1:GetSiteIDByRef>', XSD_ANYXML));
        } catch (\Exception $e) {
            dd($e);
        }

        return $response->subSiteID;
    }

    /**
     * Gets a list of Sub Sites based on filter
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetSubSitesResponse
     */
    protected function getSubSites(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null):?GetSubSitesResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('SubSiteID', 'Asc');

        $response = $this->client->XmlQuerySubSites(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if($this->errorResponse($response->XmlQuerySubSitesResult)) throw new \Exception('No subsite result');

        $result = $this->xmlToObject($response->XmlQuerySubSitesResult->Result);

        $this->get_subsites_response->setResponse($result);

        return $this->get_subsites_response;
    }
}