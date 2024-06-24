<?php

namespace App\Http\Controllers;

use App\Models\ProductCart;
use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    public function AddToCart(Request $request)
    {
        $userId = $request->user_id;
        $productId = $request->product_id;
        $productDetailsId = $request->product_details_id;
        $quantity = $request->quantity;
        $product = ProductList::where('id',$productId)->first();
        if ($product->special_price === ''){
            $totalPrice = $product->price * $quantity;
        } else {
            $totalPrice = $product->special_price * $quantity;
        }
        $result = ProductCart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'product_details_id' => $productDetailsId,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
        ]);
        return $result;
    }
}
