<?php

namespace App;

use App\Product;
use App\Scopes\SellerScope;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\SellerTransformer;

class Seller extends User
{
    public $transformer=SellerTransformer::class;
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SellerScope); 
    }
    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
