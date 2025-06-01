<?php

namespace App\Http\Controllers\User;

use App\Models\CartList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartListController extends Controller
{
    public function AddToCart(Request $request)
    {
        $user = Auth::user();
        try {
            $result = CartList::create([
                'user_id' => $user->id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity,
                'total_price' => $request->total_price,
            ]);
            return response([
                'message' => 'Add To Cart Successfully',
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 401);
        }
        return response([
            'message' => 'Something Wrong'
        ], 401);
    }

    public function CartCount()
    {
        $user = Auth::user();
        $count = CartList::where('user_id', $user->id)->count();
        return $count;
    }

    public function UserCartList()
    {
        $user = Auth::user();
        $list = CartList::where('user_id', $user->id)->with(['variant.product.images','variant.color','variant.size','user.addresses'])->get();
        return $list;
    }

    public function RemoveCart(Request $request)
    {
        $user = Auth::user();
        try {
            CartList::where('user_id',$user->id)->where('id',$request->id)->delete();
            return response([
                'message' => 'Item Successfully Deleted',
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
            ], 401);
        }
    }

    public function CartState(Request $request)
    {
        $user = Auth::user();
        $exists = CartList::where('user_id', $user->id)->where('product_id', $request->product_id)->exists();
        return $exists;
    }

    public function QuantityIncrease(Request $request)
    {
        $item = CartList::findOrFail($request->id);
        $price = $item->total_price / $item->quantity;
        $quantity = $item->quantity + 1;
        $totalPrice = $price * $quantity;
        $item->update([
            'quantity' => $quantity,
            'total_price' => $totalPrice
        ]);
        return response([
            'quantity' => $quantity,
            'total_price' => $totalPrice,
        ],200);
    }

    public function QuantityDecrease(Request $request)
    {
        $item = CartList::findOrFail($request->id);
        $price = $item->total_price / $item->quantity;
        $quantity = $item->quantity - 1;
        $totalPrice = $price * $quantity;
        $item->update([
            'quantity' => $quantity,
            'total_price' => $totalPrice
        ]);
        return response([
            'quantity' => $quantity,
            'total_price' => $totalPrice,
        ],200);
    }

}
