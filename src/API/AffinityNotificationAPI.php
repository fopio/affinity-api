<?php namespace Fopio\AffinityAPI\API;

/**
 * Class AffinitySiteAPI
 * @package App\Packages\Affinity
 */
class AffinityNotificationAPI extends AffinityAPICore
{
    /**
     * Sends notification to affinity for screen popping
     * @param $type - 'Site' 'Ticket'
     * @param $key - 'ID'
     * @param $key_reference
     * @param $affinity_user_id
     * @return object
     */
    protected function sendNotification($type, $key, $key_reference, $affinity_user_id)
    {
        $response = $this->client->XmlAddNotificationByConnectionAndID(array('IdentityToken' => $this->getToken(),
            'connection' => array(
                'ConnectionType' => $type,
                'ConnectionKeyType' => $key,
                'ConnectionKeyReference' => $key_reference
            ),
            'notifyUserID' => $affinity_user_id,
            'notifyAction' => 'AutoOpen'));

        return $response;
    }
}