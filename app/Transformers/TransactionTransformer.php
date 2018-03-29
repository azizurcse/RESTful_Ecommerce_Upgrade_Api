<?php

namespace App\Transformers;

use App\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'identifier'=>(int)$transaction->id,
            'quantity'=>(int)$transaction->quantity,
            'buyer'=>(int)$transaction->buyer_id,
            'product'=>(int)$transaction->product_id,
            'creationDate'=>(string)$transaction->created_at,
            'lastDate'=>(string)$transaction->updated_at,
            'deletedDate'=>isset($transaction->deleted_at) ? (string) $transaction->deleted_at : null,

            'links'=>[
                [
                    'rel'=>'self',
                    'href'=>route('transactions.show',$transaction->id),
                ],
                [
                    'rel'=>'transaction.categories',
                    'href'=>route('transactions.categories.index',$transaction->id),
                ],
                [
                    'rel'=>'transaction.seller',
                    'href'=>route('transactions.sellers.index',$transaction->id),
                ],
                [
                    'rel'=>'buyer',
                    'href'=>route('buyers.show',$transaction->seller_id),
                ],
                [
                    'rel'=>'product',
                    'href'=>route('products.show',$transaction->seller_id),
                ]
            ]
        ];
    }

    public static function originalAttribute($index)
    {
        $attibutes=[
            'identifier'=>'id',
            'quantity'=>'quantity',
            'buyer'=>'buyer_id',
            'product'=>'product_id',
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
            'quantity'=>'quantity',
            'buyer_id'=>'buyer',
            'product_id'=>'product',
            'created_at'=>'creationDate',
            'updated_at'=>'lastDate',
            'deleted_at'=>'deletedDate',
        ];
        return isset($attibutes[$index]) ? $attibutes[$index] : null;
    }
}
