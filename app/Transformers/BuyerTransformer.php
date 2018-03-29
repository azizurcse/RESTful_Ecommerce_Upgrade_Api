<?php

namespace App\Transformers;

use App\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            'identifier'=>(int)$buyer->id,
            'name'=>(string)$buyer->name,
            'email'=>(string)$buyer->email,
            'isVerified'=>(int)$buyer->verified,
            'creationDate'=>(string)$buyer->created_at,
            'lastDate'=>(string)$buyer->updated_at,
            'deletedDate'=>isset($buyer->deleted_at) ? (string) $buyer->deleted_at : null,

            'links'=>[
                [
                    'rel'=>'self',
                    'href'=>route('buyers.show',$buyer->id),
                ],
                [
                    'rel'=>'buyer.categories',
                    'href'=>route('buyers.categories.index',$buyer->id),
                ],
                [
                    'rel'=>'buyer.products',
                    'href'=>route('buyers.products.index',$buyer->id),
                ],
                [
                    'rel'=>'buyer.sellers',
                    'href'=>route('buyers.sellers.index',$buyer->id),
                ],
                [
                    'rel'=>'buyer.transactions',
                    'href'=>route('buyers.transactions.index',$buyer->id),
                ]
            ]
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


    public static function transformedAttribute($index)
    {
        $attibutes=[
            'id'=>'identifier',
            'name'=>'name',
            'email'=>'email',
            'verified'=>'isVerified',
            'created_at'=>'creationDate',
            'updated_at'=>'lastDate',
            'deleted_at'=>'deletedDate',
        ];
        return isset($attibutes[$index]) ? $attibutes[$index] : null;
    }
}
