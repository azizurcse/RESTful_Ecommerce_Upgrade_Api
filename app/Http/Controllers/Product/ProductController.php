<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductController extends ApiController
{

    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $products=Product::all();
        return $this->showAll($products);
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // if($product->quantity == 0 && $product->isAvailable())
        //     {
        //         $product->status = Product::UNAVAILABLE_PRODUCT;
        //         $product->save();
        //     }
        return $this->showOne($product);
    }

    
}
