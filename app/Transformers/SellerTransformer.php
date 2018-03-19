<?php

namespace App\Transformers;

use App\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'identifier'=>(int)$seller->id,
            'name'=>(string)$seller->name,
            'email'=>(string)$seller->email,
            'isVerified'=>(int)$seller->verified,
            'creationDate'=>(string)$seller->created_at,
            'lastDate'=>(string)$seller->updated_at,
            'deletedDate'=>isset($seller->deleted_at) ? (string) $seller->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attibutes=[
            'identifier'=>'id',
            'name'=>'name',
            'email'=>'email',
            'isVerified'=>'verified',
            'creationDate'=>'created_at',
            'lastDate'=>'updated_at',
            'deletedDate'=>'deleted_at',
        ];
        return isset($attibutes[$index]) ? $attibutes[$index] : null;
    }
}
