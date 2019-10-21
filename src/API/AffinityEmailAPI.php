<?php namespace Fopio\AffinityAPI\API;
use Fopio\AffinityAPI\Responses\EmailAddresses\GetEmailAddressesResponse;
use Fopio\AffinityAPI\Responses\EmailAddresses\GetEmailAddressResponse;

/**
 * Class AffinityEmailAPI
 * @package App\Packages\Affinity
 */
class AffinityEmailAPI extends AffinityAPICore
{
    protected $get_email_address_response;

    protected $get_email_addresses_response;

    public function __construct()
    {
        $this->get_email_address_response = new GetEmailAddressResponse();

        $this->get_email_addresses_response = new GetEmailAddressesResponse();

        parent::__construct();
    }

    /**
     * Get list off email address
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return object
     */
    protected function getEmailAddresses(Filter $filter, $offset = 0, $qty = 30, Projection $projection = null, Ordering $ordering = null)
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('EmailId', 'Asc');

        $this->filter->create()->field('Status', '!=', 'Closed');

        $response = $this->client->XmlQueryEmailAddresses(array('identityToken' => $this->getToken(),
            'numberOfItemsToSkip' => $offset,
            'numberOfItemsToTake' => $qty,
            'filterXml' => $filter->getFilterXML(),
            'projectionXml' => $projection->getProjectionXML(),
            'orderingXml' => $ordering->getOrderingXML(),
            'connectionType' => 'Site'));

        if ($this->errorResponse($response->XmlQueryEmailAddressesResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlQueryEmailAddressesResult->Result);

        $this->get_email_addresses_response->setResponse($result);

        return $this->get_email_addresses_response;
    }
}