<?php

namespace App\Http\Controllers\User;

use App\Models\CartList;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

class OrderListController extends Controller
{
    public function AddToOrderList(Request $request)
    {
        $user = Auth::user();
        $cartList = CartList::where('user_id',$user->id)->get();
        if ($cartList>isEmpty()){
            return response([
                'message' => 'Your Cart List Is Empty'
            ], 401);
        }
        try {
            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $request->address_id,
                'payment_rule_id' => $request->payment_rule_id,
                'order_no' => 'SMT-' . now()->format('Ymd') . '-' . mt_rand(),
                'payment_status' => 'paid',
                'total_price' => $request->total_price,
                'transaction_id' => Str::uuid()->toString(),
                'status' => 'processing',
                'note' => $request->order_note,
            ]);
            foreach ($cartList as $item){
                OrderList::create([
                    'order_id' => $order->id,
                    'user_id' => $user->id,
                    'variant_id' => $item->variant_id,
                    'quantity' => $item->quantity,
                    'total_price' => $item->total_price,
                    'status' => 'pending',
                ]);
                $variant = Variant::find($item->variant_id);
                if ($variant) {
                    $variant->stock = max(0, $variant->stock - $item->quantity);
                    $variant->save();
                }
            }
            CartList::where('user_id',$user->id)->delete();
            return response([
                'message' => 'Successful Order',
            ], 200);
        }catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 401);
        }
        return response([
            'message' => 'Something Wrong'
        ], 401);
    }

    public function Orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id',$user->id)->orderBy('id','DESC')->with(['orderList.variant.product','orderList.variant.size','orderList.variant.color','orderList.variant.product.images'])->get();
        return $orders;
    }
}
