<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Requests\Sites\SiteUpdateRequest;
use Fopio\AffinityAPI\Responses\Sites\GetSiteResponse;
use Fopio\AffinityAPI\Responses\Sites\GetSitesResponse;

/**
 * Class AffinitySiteAPI
 * @package App\Packages\Affinity
 */
class AffinitySiteAPI extends AffinityAPICore
{
    protected $get_site_response;

    protected $get_sites_response;

    public function __construct()
    {
        $this->get_site_response = new GetSiteResponse();

        $this->get_sites_response = new GetSitesResponse();

        parent::__construct();
    }

    /**
     * Gets the number of sites based on the filter
     * @param Filter $filter
     * @throws \Exception
     * @return int
     */
    protected function getSiteCount(Filter $filter):int
    {
        $response = $this->client->XmlGetSiteCount(array('identityToken' => $this->getToken(), 'filterXml' => $filter->getFilterXML()));

        if ($this->errorResponse($response->XmlGetSiteCountResult)) throw new \Exception('API response had no results');

        $result = $this->xmlToObject($response->XmlGetSiteCountResult->Result);

        return $result->SiteCount;
    }

    /**
     * Gets the Site information based on site ID
     * @param int $site_id
     * @throws \Exception
     * @return GetSiteResponse
     */
    protected function getSiteById(int $site_id):?GetSiteResponse
    {
        $response = $this->client->XmlGetSiteById(array('identityToken' => $this->getToken(), 'siteID' => $site_id));

        if ($this->errorResponse($response->XmlGetSiteByIDResult)) throw new \Exception('No site result received.' . serialize($response));

        $result = $this->xmlToObject($response->XmlGetSiteByIDResult->Result, false);

        $this->get_site_response->setResponse($result);

        return $this->get_site_response;
    }

    /**
     * Get a site from the UID. Uses the getSites function with XML filter, and limits to just one result. returns the
     * site of the object.
     * @param $site_uid
     * @return mixed
     */
    protected function getSiteByUid(string $site_uid)
    {
        $xml = '<Filter>
                   <Group type="NONE" name="Where SiteUID >">
                      <Field>
                          <Name>SiteUID</Name>
                          <Operator>equalTo</Operator>
                          <Value>' . $site_uid . '</Value>
                      </Field>     
                   </Group>
               </Filter>';

        $response = $this->getSites($xml, 0, 1);

        return $response->Site;
    }


    /**
     * Gets the Site ID based on ref code
     * @param $site_id
     * @return object
     */
    protected function getSiteByRef(string $site_ref)
    {
        try {
            $response = $this->client->GetSiteIDByRef(new \SoapVar('<ns1:GetSiteIDByRef>', XSD_ANYXML), new \SoapVar('<ns1:IdentityToken>' . $this->getToken() . '</ns1:IdentityToken>', XSD_ANYXML), new \SoapVar('<ns1:siteRef>' . $site_ref . '</ns1:siteRef>', XSD_ANYXML), new \SoapVar('</ns1:GetSiteIDByRef>', XSD_ANYXML));
        } catch (\Exception $e) {
            dd($e);
        }

        return $response->siteID;
    }

    /**
     * Gets a list of Sites based on filter
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetSitesResponse
     */
    protected function getSites(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null): GetSitesResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('SiteID', 'Asc');

        $response = $this->client->XmlQuerySites(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if($this->errorResponse($response->XmlQuerySitesResult)) throw new \Exception('API response had no results');

        $result = $this->xmlToObject($response->XmlQuerySitesResult->Result);

        $this->get_sites_response->setResponse($result);

        return $this->get_sites_response;
    }

    /**
     * Creats a new site and returns site ID
     * @param string $site_name
     * @param string $site_ref
     * @param int $dealer_id
     * @throws \Exception
     * @return int siteID
     */
    protected function createNewSite(string $site_name, string $site_ref, int $dealer_id):? int
    {
        $response = $this->client->CreateNewSiteByID(new \SoapVar('<ns1:CreateNewSiteByID>',XSD_ANYXML),
            new \SoapVar('<ns1:IdentityToken>' . $this->getToken() . '</ns1:IdentityToken>', XSD_ANYXML),
            new \SoapVar('<ns1:siteName>' . $site_name . '</ns1:siteName>', XSD_ANYXML),
            new \SoapVar('<ns1:siteRef>' . $site_ref . '</ns1:siteRef>', XSD_ANYXML),
            new \SoapVar('<ns1:dealerID>' . $dealer_id . '</ns1:dealerID>', XSD_ANYXML),
            new \SoapVar('</ns1:CreateNewSiteByID>', XSD_ANYXML));

        if ($this->errorResponse($response->CreateNewSiteByIDResult)) throw new \Exception('Affinity missing results');

        return $response->siteID;
    }

    /**
     * Updates a site using the site ID
     * @param int $site_id
     * @param SiteUpdateRequest $siteUpdateRequest
     * @return object
     * @throws \Exception
     */
    protected function updateSiteByID(int $site_id, SiteUpdateRequest $siteUpdateRequest)
    {
        if(!$siteUpdateRequest->isValid()) throw new \Exception('Update site request not valid. '.serialize($siteUpdateRequest->getErrors()));

        $site_xml = $this->arrayToXMLString($siteUpdateRequest->getRequestArray(), 'Site');

        $response = $this->client->XmlUpdateSiteByID(array('identityToken' => $this->getToken(), 'siteID' => $site_id, 'siteXml' => $site_xml));

        if ($this->errorResponse($response->XmlUpdateSiteByIDResult)) throw new \Exception('Affinity missing results');

        return $this->xmlToObject($response->XmlUpdateSiteByIDResult->Result);
    }
}