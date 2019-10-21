<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Requests\Contacts\ContactCreateRequest;
use Fopio\AffinityAPI\Requests\Contacts\SiteContactCreateRequest;
use Fopio\AffinityAPI\Responses\Contacts\GetContactResponse;
use Fopio\AffinityAPI\Responses\Contacts\GetContactsResponse;

/**
 * Class AffinitySiteAPI
 * @package App\Packages\Affinity
 */
class AffinityContactAPI extends AffinityAPICore
{
    protected $get_contact_response;

    protected $get_contacts_response;

    public function __construct()
    {
        $this->get_contact_response = new GetContactResponse();

        $this->get_contacts_response = new GetContactsResponse();

        parent::__construct();
    }

    /**
     * Get contact by site
     * @param int $site_id
     * @return GetContactResponse
     */
    protected function getContactBySiteID(int $site_id):GetContactResponse
    {
        try {
            $response = $this->client->XmlGetContactByConnection(array('IdentityToken' => $this->getToken(),
                'connection' => array(
                    'ConnectionType' => 'Site',
                    'ConnectionKeyType' => 'ID',
                    'ConnectionKeyReference' => $site_id
                ),
                'contactType' => 'Site',
            ));

            if ($this->errorResponse($response->XmlGetContactByConnectionResult)) throw new \Exception('Affinity missing results');

            $result = $this->xmlToObject($response->XmlGetContactByConnectionResult->Result);

            $this->get_contact_response->setResponse($result->Contact);

            return $this->get_contact_response;
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            dd($result);
        }
    }

    /**
     * Create a contact
     * @param ContactCreateRequest $contactCreateRequest
     */
    protected function createContact(ContactCreateRequest $contactCreateRequest)
    {
        $contact_xml = $this->arrayToXMLString($contactCreateRequest->getRequestArray(), 'Contact');

        $response = $this->client->XmlAddContact(array('identityToken' => $this->getToken(), 'contactXml' => $contact_xml));

        return $response;
    }

    /**
     * Create a contact for Site
     * @param SiteContactCreateRequest $siteContactCreateRequest
     */
    protected function createSiteContact(SiteContactCreateRequest $siteContactCreateRequest)
    {
        $response = $this->client->UpdateSiteContactByID(array('IdentityToken' => $this->getToken(),
            'siteID' => $siteContactCreateRequest->getField('siteID'),
            'contactType' => $siteContactCreateRequest->getField('contactType'),
            'contactTitle' => $siteContactCreateRequest->getField('contactTitle'),
            'contactFirstName' => $siteContactCreateRequest->getField('contactFirstName'),
            'contactLastName' => $siteContactCreateRequest->getField('contactLastName'),
            'contactTelephoneNumber' => $siteContactCreateRequest->getField('contactTelephoneNumber'),
            'contactMobileNumber' => $siteContactCreateRequest->getField('contactMobileNumber'),
            'contactEmailAddress' => $siteContactCreateRequest->getField('contactEmailAddress'),
        ));

        return $response;
    }
}