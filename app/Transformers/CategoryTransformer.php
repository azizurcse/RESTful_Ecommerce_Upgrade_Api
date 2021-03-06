<?php

namespace App\Transformers;

use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'identifier'=>(int)$category->id,
            'title'=>(string)$category->name,
            'details'=>(string)$category->description,
            'creationDate'=>(string)$category->created_at,
            'lastDate'=>(string)$category->updated_at,
            'deletedDate'=>isset($category->deleted_at) ? (string) $category->deleted_at : null,

            'links'=>[
                [
                    'rel'=>'self',
                    'href'=>route('categories.show',$category->id),
                ],
                [
                    'rel'=>'category.buyers',
                    'href'=>route('categories.buyers.index',$category->id),
                ],
                [
                    'rel'=>'category.products',
                    'href'=>route('categories.products.index',$category->id),
                ],
                [
                    'rel'=>'category.sellers',
                    'href'=>route('categories.sellers.index',$category->id),
                ],
                [
                    'rel'=>'category.transactions',
                    'href'=>route('categories.transactions.index',$category->id),
                ]
            ]
        ];  
    }

   public static function originalAttribute($index)
    {
        $attibutes=[
            'identifier'=>'id',
            'title'=>'name',
            'details'=>'description',
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
            'name'=>'title',
            'description'=>'details',
            'created_at'=>'creationDate',
            'updated_at'=>'lastDate',
            'deleted_at'=>'deletedDate',
        ];
        return isset($attibutes[$index]) ? $attibutes[$index] : null;
    }
}
