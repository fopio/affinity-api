<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Responses\Teams\GetTeamResponse;
use Fopio\AffinityAPI\Responses\Teams\GetTeamsResponse;

/**
 * Class AffinityTeamAPI
 * @package App\Packages\Affinity
 */
class AffinityTeamAPI extends AffinityAPICore
{
    protected $get_team_response;

    protected $get_teams_response;

    public function __construct()
    {
        $this->get_team_response = new GetTeamResponse();

        $this->get_teams_response = new GetTeamsResponse();

        parent::__construct();
    }

    /**
     * Gets the number of team based on the filter
     * @param Filter $filter
     * @throws \Exception
     * @return int
     */
    protected function getTeamCount(Filter $filter):int
    {
        $response = $this->client->XmlGetAffinityTeamCount(array('identityToken' => $this->getToken(), 'filterXml' => $filter->getFilterXML()));

        if ($this->errorResponse($response->XmlGetAffinityTeamCountResult)) throw new \Exception('No team count result received.' . serialize($response));

        $result = $this->xmlToObject($response->XmlGetAffinityTeamCountResult->Result);

        return $result->AffinityTeamCount;
    }

    /**
     * Get a team based on the team id
     * @param int $team_id
     * @throws \Exception
     * @return GetTeamResponse
     */
    protected function getTeamByID(int $team_id):?GetTeamResponse
    {
        $response = $this->client->XmlGetAffinityTeamByID(array('identityToken' => $this->getToken(), 'teamID' => $team_id));

        if ($this->errorResponse($response->XmlGetAffinityTeamByIDResult)) throw new \Exception('No team result received.' . serialize($response));

        $result = $this->xmlToObject($response->XmlGetAffinityTeamByIDResult->Result);

        $this->get_team_response->setResponse($result->AffinityTeam);

        return $this->get_team_response;
    }

    /**
     * Gets selection of team based on query
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetTeamsResponse
     */
    protected function getTeams(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null):?GetTeamsResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if (!$ordering) $ordering = $this->default_ordering->create()->field('TeamId', 'Asc');

        $response = $this->client->XmlQueryAffinityTeams(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if($this->errorResponse($response->XmlQueryAffinityTeamsResult)) throw new \Exception('API response had no results');

        $result = $this->xmlToObject($response->XmlQueryAffinityTeamsResult->Result);

        $this->get_teams_response->setResponse($result);

        return $this->get_teams_response;
    }

}