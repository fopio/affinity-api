<?php namespace Fopio\AffinityAPI\Traits;

use Carbon\Carbon;

trait DatesTrait
{
    /**
     * Takes a fields and converts it into a Carbon date.
     * @param string $affinity_date_field
     * @return Carbon|null
     */
    public function carbonDateFromAffinityField($affinity_date_field):? Carbon
    {
      try{
          if(is_string($affinity_date_field)) {
              return Carbon::createFromFormat('Y-m-d H:i:s', substr(str_replace('T', ' ', $affinity_date_field), 0, 19));
          }else{
              return null;
          }
      }catch (\Exception $e){
          return null;
      }
    }
}