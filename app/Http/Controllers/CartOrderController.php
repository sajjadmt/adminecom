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
        $userId = $request->userId;
        $productCarts = ProductCart::where('user_id', $userId)->get();
        foreach ($productCarts as $productCart) {
            $creation = CartOrder::create([
                'product_cart_id' => $productCart['id'],
                'user_id' => $userId,
                'product_id' => $productCart['product_id'],
                'city' => $city,
                'payment' => $payment,
                'address' => $address,
            ]);
            $result = ProductCart::where('id', $productCart['id'])->delete();
        }
        return $result;
    }

    public function OrderHistory(Request $request)
    {

        $userId = $request->userId;
        $result = CartOrder::with(['product', 'productCart' => function($query) {
            $query->withTrashed();
        }])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        return $result;

    }

}
