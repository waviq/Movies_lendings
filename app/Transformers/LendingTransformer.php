<?php

namespace App\Transformers;

use App\Lending;
use League\Fractal\TransformerAbstract;

class LendingTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Lending $lending)
    {
        $return_date = '';
        if (empty($lending->return_date)) {
            $return_date = null;
        }else {
            $return_date = date('Y-m-d',strtotime($lending->return_date));
        }
        return [
            'id'                =>  $lending->id,
            'movie'             =>  $lending->movie->title,
            'member'            =>  $lending->member->name,
            'lending_date'      =>  date('Y-m-d',strtotime($lending->lending_date)),
            'return_date'       =>  $return_date,
            'lateness_charge'   =>  $lending->lateness_charge,
            'created_at'        =>  date('Y-m-d h:m:s',strtotime($lending->created_at))
        ];
    }
}
