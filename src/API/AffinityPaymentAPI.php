<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Requests\Payments\PaymentUpdateRequest;

/**
 * Class AffinityPaymentAPI
 * @package App\Packages\Affinity
 */
class AffinityPaymentAPI extends AffinityAPICore
{
    /**
     * Updates the payment details to a site
     * @param PaymentUpdateRequest $paymentUpdateRequest
     * @return object
     */
    protected function updateSitePaymentDetails(PaymentUpdateRequest $paymentUpdateRequest)
    {
        try {
            $response = $this->client->UpdateSitePaymentDetailsByID(array('IdentityToken' => $this->getToken(),
                'siteID' => $paymentUpdateRequest->getField('SiteID'),
                'paymentMethod' => $paymentUpdateRequest->getField('paymentMethod'),
                'paymentTerms' => $paymentUpdateRequest->getField('paymentTerms'),
                'bankAccountReference' => $paymentUpdateRequest->getField('bankAccountReference'),
                'bankAccountNumber' => $paymentUpdateRequest->getField('bankAccountNumber'),
                'bankAccountSortCode' => $paymentUpdateRequest->getField('bankAccountSortCode'),
                'ddReference' => $paymentUpdateRequest->getField('ddReference'),
            ));

            if ($this->errorResponse($response->UpdateSitePaymentDetailsByIDResult)) throw new \Exception('Affinity missing results');

            return $this->xmlToObject($response->UpdateSitePaymentDetailsByIDResult->Result);
        }catch (\Exception $e){
            var_dump($e->getMessage());

            dd($response);
        }
        return $response;
    }
}