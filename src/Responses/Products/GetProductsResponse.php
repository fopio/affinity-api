<?php namespace Fopio\AffinityAPI\Responses\Products;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityProductObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetProductsResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityNoteObject;

    protected $affinity_product_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_product_objects = [];

        if(isset($affinity_response->ProductItems->ProductItem)){
            foreach($affinity_response->ProductItems->ProductItem as $affinity_product){
                $this->appendObject($affinity_product);
            }
        }elseif(isset($affinity_response->Site)){
            $this->appendObject($affinity_response->ProductItem);
        }

        return $this;
    }

    protected function appendObject($affinity_product){
        $affinity_product_object = new AffinityProductObject();

        $affinity_product_object->setObject($affinity_product);

        $this->affinity_product_objects[] = $affinity_product_object;
    }

    public function getResponse(): array
    {
        return $this->affinity_product_objects;
    }
}