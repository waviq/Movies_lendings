<?php

namespace App\Transformers;

use App\Member;
use League\Fractal\TransformerAbstract;

class MemberTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Member $member)
    {

        return [
            'id'            =>  $member->id,
            'name'          =>  $member->name,
            'age'           =>  $member->age,
            'address'       =>  $member->address,
            'telephone'     =>  $member->telephone,
            'lc_number'     =>  $member->lc_number,
            'date_of_joined'=>  date('Y-m-d',strtotime($member->date_of_joined)),
            'is_active'     =>  $member->is_active,
            'created_at'    =>  date('Y-m-d h:m:s',strtotime($member->created_at))
        ];
    }
}
