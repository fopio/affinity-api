<?php namespace Fopio\AffinityAPI\API;

use Carbon\Carbon;
use Fopio\AffinityAPI\Responses\Tariffs\GetAssignedTariffResponse;
use Fopio\AffinityAPI\Responses\Tariffs\GetAssignedTariffsResponse;
use Fopio\AffinityAPI\Responses\Tariffs\GetTariffResponse;
use Fopio\AffinityAPI\Responses\Tariffs\GetTariffsResponse;

/**
 * Class AffinityTariffAPI
 * @package App\Packages\Affinity
 */
class AffinityTariffAPI extends AffinityAPICore
{
    protected $get_tariff_response;

    protected $get_tariffs_response;

    protected $get_assigned_tariff_response;

    protected $get_assigned_tariffs_response;

    public function __construct()
    {
        $this->get_tariff_response = new GetTariffResponse();

        $this->get_tariffs_response = new GetTariffsResponse();

        $this->get_assigned_tariff_response = new GetAssignedTariffResponse();

        $this->get_assigned_tariffs_response = new GetAssignedTariffsResponse();

        parent::__construct();
    }

    protected function getProductTariffBySiteID($site_id)
    {
        $response = $this->client->XmlGetAssignedProductTariffSchemeByID(array('identityToken' => $this->getToken(), 'assignedID' => $site_id, 'connectionType' => 'Site'));

        if ($this->errorResponse($response->XmlGetAssignedProductTariffSchemeByIDResult)) throw new \Exception('Affinity missing results ' . serialize($response));

        return $this->xmlToObject($response->XmlGetAssignedProductTariffSchemeByIDResult->Result);
    }

    /**
     * Get the product tariffs
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return object
     */
    protected function getProductTariffs(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null)
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('SchemeID', 'Asc');

        $response = $this->client->XmlQueryProductTariffSchemes(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if($this->errorResponse($response->XmlQueryProductTariffSchemesResult)) throw new \Exception('No tariff response ' . serialize($response));

        $result = $this->xmlToObject($response->XmlQueryProductTariffSchemesResult->Result);

        $this->get_tariffs_response->setResponse($result);

        return $this->get_tariffs_response;
    }


    /**
     * Get the product assigned tariffs, maybe to Site
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetAssignedTariffsResponse
     */
    protected function getAssignedProductTariffs(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null):?GetAssignedTariffsResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('SiteID', 'Asc');

        $response = $this->client->XmlQueryAssignedProductTariffSchemes(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML(), 'connectionType' => 'Site'));

        if($this->errorResponse($response->XmlQueryAssignedProductTariffSchemesResult)) throw new \Exception('No assigned tariff response ' . serialize($response));

        $result = $this->xmlToObject($response->XmlQueryAssignedProductTariffSchemesResult->Result);

        $this->get_assigned_tariffs_response->setResponse($result);

        return $this->get_assigned_tariffs_response;
    }

    /**
     * Get the product assigned tariffs, maybe to Site
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return int
     */
    protected function getAssignedProductTariffsCount(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null):int
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('SiteID', 'Asc');

        $response = $this->client->XmlGetAssignedProductTariffSchemeCount(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML(), 'connectionType' => 'Site'));

        if($this->errorResponse($response->XmlGetAssignedProductTariffSchemeCountResult)) throw new \Exception('No tariff response ' . serialize($response));

        $result = $this->xmlToObject($response->XmlGetAssignedProductTariffSchemeCountResult->Result);

        $this->get_tariffs_response->setResponse($result);

        return (int)$result->SiteProductTariffSchemeCount;
    }

    /**
     * Assigns a product tariff to a site
     * @param $assign_array [ 'SiteID', 'SchemeID', 'StartDate']
     * @throws \Exception
     * @return object|false
     */
    protected function assignProductTariff($assign_array)
    {
        $assignedTariffSchemeXml = $this->arrayToXMLString($assign_array, 'SiteProductTariffScheme');

        $response = $this->client->XmlAddAssignedProductTariffScheme(array('identityToken' => $this->getToken(), 'connectionType' => 'Site', 'assignedTariffSchemeXml' => $assignedTariffSchemeXml));

        if (isset($response->XmlQueryAssignedProductTariffSchemeResult->Result)) {

            if ($this->errorResponse($response->XmlQueryAssignedProductTariffSchemeResult)) throw new \Exception('Affinity missing results ' . serialize($response));

            return $this->xmlToObject($response->XmlQueryAssignedProductTariffSchemeResult->Result);
        }

        return false;
    }

    protected function getSiteTariffOverride($product_item_id, Carbon $date)
    {
        $response = $this->client->XmlGetSiteProductItemTariffOverrideByIDAndDate(array('identityToken' => $this->getToken(), 'siteProductItemID' => $product_item_id, 'tariffDate' => $date->toW3cString()));

        dd($response);
    }

    protected function addSiteTariffOverride($site_product_item_id, $cost_in_pence, Carbon $date)
    {
        $tariff_override = [
            'SiteProductItemID' => $site_product_item_id,
            'StartDate' => $date->startOfDay()->toW3cString(),
            'TariffLevel' => 'Site',
            'CurrencyCode' => null,
            'TariffParts' => [
                'TariffPart' => [
                    'PartOrder' => 0,
                    'MaxDurationInMonths' => 999,
                    'Cost' => $cost_in_pence / 100,
                    'Uplift' => 0,
                ]
            ]
        ];

        $tariffOverrideXml = $this->arrayToXMLString($tariff_override, 'SiteProductItemTariffOverride');

        return $this->client->XmlAddSiteProductItemTariffOverride(array('identityToken' => $this->getToken(), 'tariffOverrideXml' => $tariffOverrideXml));
    }
}