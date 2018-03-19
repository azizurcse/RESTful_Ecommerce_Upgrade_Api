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
}
