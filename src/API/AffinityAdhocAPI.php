<?php namespace Fopio\AffinityAPI\API;

use Carbon\Carbon;

class AffinityAdhocAPI extends AffinityAPICore
{
    /**
     * Gets the tickets with a recent event
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @return object
     */
    protected function getAdhocTickets(Filter $filter, $offset = 0, $qty = 30, Projection $projection = null, Ordering $ordering = null)
    {
        if ($ordering_xml == null) $ordering_xml = '<Ordering><Fields><Field><Name>Date</Name><Direction>Desc</Direction></Field></Fields></Ordering>';

        $adhocArguments = [
            'ObjectName' => 'TicketEvent',
            'XmlRootNode' => 'TicketID',
            'ObjectIDField' => 'Events',
        ];

        $response = $this->client->XmlQueryAdhocObjects(array('identityToken' => $this->getToken(), 'adhocArguments' => $adhocArguments, 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if ($this->errorResponse($response->XmlQueryAdhocObjectsResult)) throw new \Exception('Affinity missing results');

        return $this->xmlToObject($response->XmlQueryAdhocObjectsResult->Result);
    }

    /**
     * Gets the quantity of recent event tickets
     * @param Filter $filter
     * @return int
     */
    protected function getAdhocTicketsCount($filter_xml)
    {
        $adhocArguments = [
            'ObjectName' => 'TicketEvent',
            'XmlRootNode' => 'TicketID',
            'ObjectIDField' => 'Events',
        ];

        $response = $this->client->XmlGetAdhocObjectCount(array('identityToken' => $this->getToken(), 'adhocArguments' => $adhocArguments, 'filterXml' => $filter_xml));

        if ($this->errorResponse($response->XmlGetAdhocObjectCountResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetAdhocObjectCountResult->Result);

        return (int)$result->TicketEventCount;
    }
}