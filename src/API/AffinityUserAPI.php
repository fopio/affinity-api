<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Responses\Users\GetUserResponse;
use Fopio\AffinityAPI\Responses\Users\GetUsersResponse;

/**
 * Class AffinityUserAPI
 * @package App\Packages\Affinity
 */
class AffinityUserAPI extends AffinityAPICore
{
    protected $get_user_response;

    protected $get_users_response;

    public function __construct()
    {
        $this->get_user_response = new GetUserResponse();

        $this->get_users_response = new GetUsersResponse();

        parent::__construct();
    }

    /**
     * Gets the number of users based on the filter
     * @param Filter $filter
     * @throws \Exception
     * @return int
     */
    protected function getUserCount(Filter $filter): int
    {
        $response = $this->client->XmlGetAffinityUserCount(array('identityToken' => $this->getToken(), 'filterXml' => $filter->getFilterXML()));

        if ($this->errorResponse($response->XmlGetAffinityUserCountResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetAffinityUserCountResult->Result);

        return $result->AffinityUserCount;
    }

    /**
     * Gets the User information based on user ID
     * @param int $user_id
     * @throws \Exception
     * @return GetUserResponse
     */
    protected function getUserById(int $user_id):?GetUserResponse
    {
        $response = $this->client->XmlGetAffinityUserById(array('identityToken' => $this->getToken(), 'userID' => $user_id));

        if ($this->errorResponse($response->XmlGetAffinityUserByIDResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetAffinityUserByIDResult->Result);

        $this->get_user_response->setResponse($result);

        return $this->get_user_response;
    }


     /**
     * Gets a list of Users based on filter
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetUsersResponse
     */
    protected function getUsers(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null):?GetUsersResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if(!$ordering) $ordering = $this->default_ordering->create()->field('UserId', 'Asc');

        $response = $this->client->XmlQueryAffinityUsers(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlQueryAffinityUsersResult)) throw new \Exception('No users result received.' . serialize($response));

        $result = $this->xmlToObject($response->XmlQueryAffinityUsersResult->Result);

        $this->get_users_response->setResponse($result);

        return $this->get_users_response;
    }
}