<?php

namespace Fopio\AffinityAPI\API;

/**
 * Class AffinitySiteBroadbandAPI
 * @package App\Packages\Affinity
 */
class AffinitySiteBroadbandAPI extends AffinityAPICore
{
    /**
     * Get the SiteBroadband record by its id number
     * @param int $site_broadband_id
     * @throws \Exception
     * @return object
     */
    protected function getSiteBroadbandByID(int $site_broadband_id)
    {
        $response = $this->client->XmlGetSiteBroadbandById(array('identityToken' => $this->getToken(), 'SiteBroadbandID' => $site_broadband_id));

        if ($this->errorResponse($response->XmlGetSiteBroadbandByIDResult)) throw new \Exception('Affinity missing results');

        return $this->xmlToObject($response->XmlGetSiteBroadbandByIDResult->Result, false);
    }

    /**
     * Find SiteBroadband records based on a XML filter query. Fields like SiteID, CliID, OrderReference, Username, Password,
     * SiteBroadbandID, SiteBroadbandUID
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return object
     */
    protected function getSiteBroadbands(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null)
    {
        if (!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('SiteBroadbandID', 'Asc');

        $response = $this->client->XmlQuerySiteBroadband(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        //dd($response);
        if ($this->errorResponse($response->XmlQuerySiteBroadbandResult)) throw new \Exception('Affinity missing results');

        return $this->xmlToObject($response->XmlQuerySiteBroadbandResult->Result, false);
    }
}