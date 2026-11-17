<?php

namespace App\Http\Controllers;

use App\Http\Resources\V1\ProductResource;
use App\Models\Product1;
use App\Traits\ApiResponses;

class ProductController extends Controller
{
    use ApiResponses;

    public function index()
    {
        return $this->ok('Products retrieved successfully', ProductResource::collection(
            Product1::with('category')->paginate(10)
        ));
    }

    public function show(Product1 $product)
    {
        $product->load('category');

        return $this->ok('Product retrieved successfully', new ProductResource($product));
    }

}
