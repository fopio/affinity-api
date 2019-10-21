<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Requests\Addresses\AddressUpdateRequest;

/**
 * Class AffinityAddressAPI
 * @package App\Packages\Affinity
 */
class AffinityAddressAPI extends AffinityAPICore
{
    /**
     * updates Address by site ID
     * @param AddressUpdateRequest $addressUpdateRequest
     * @return object
     */
    protected function updateAddressBySite(AddressUpdateRequest $addressUpdateRequest)
    {
        $address_array = [
            'address1' => $addressUpdateRequest->getField('Address1'),
            'address2' => $addressUpdateRequest->getField('Address2'),
            'address3' => $addressUpdateRequest->getField('Address3'),
            'address4' => $addressUpdateRequest->getField('Town'),
            'address5' => $addressUpdateRequest->getField('County'),
            'address6' => $addressUpdateRequest->getField('PostCode'),
        ];

        $address_xml = $this->arrayToXMLString($address_array, 'Address');

        try {
            $response = $this->client->XmlUpdateAddressByConnection(array('identityToken' => $this->getToken(),
                'connection' => array(
                    'ConnectionType' => 'Site',
                    'ConnectionKeyType' => 'ID',
                    'ConnectionKeyReference' => $addressUpdateRequest->getField('SiteID')
                ),
                'addressType' => $addressUpdateRequest->getField('AddressType'),
                'addressXml' => $address_xml
            ));

            if ($this->errorResponse($response->XmlUpdateAddressByConnectionResult)) throw new \Exception('Affinity missing results');

            return $this->xmlToObject($response->XmlUpdateAddressByConnectionResult->Result);
        }catch (\Exception $e){
            var_dump($e->getMessage());

            dd($response);
        }
        return $response;
    }
}