<?php

namespace App\Http\Controllers;

use App\Models\ProductDetails;
use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function ProductDetails(Request $request)
    {
        $productDetails = ProductDetails::find($request->id)->toArray();
        $product = ProductList::find($request->id)->toArray();
        $items = [
            'Details' => $productDetails,
            'Product' => $product,
        ];
        return $items;
    }
}
