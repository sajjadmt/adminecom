<?php

namespace App\Http\Controllers;

use App\Models\CartOrder;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartOrderController extends Controller
{
    public function AddToOrder(Request $request)
    {
        $city = $request->input('city');
        $payment = $request->input('payment');
        $address = $request->input('address');
        $userId = $request->user_id;
        $productCarts = ProductCart::where('user_id', $userId)->get();
        foreach ($productCarts as $productCart) {
            $creation = CartOrder::create([
                'product_cart_id' => $productCart['id'],
                'city' => $city,
                'payment' => $payment,
                'address' => $address,
            ]);
            $result = ProductCart::where('id', $productCart['id'])->delete();
        }
        return $result;
    }
}
