<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderList;
use App\Models\PaymentRule;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function Orders()
    {
        $orders = Order::with(['user','address'])->orderBy('id','desc')->get();
        return view('admin.order.all-order', compact('orders'));
    }

    public function CompletedOrder()
    {
        $orders = Order::where('status','completed')->with(['user','address'])->orderBy('id','desc')->get();
        return view('admin.order.completed-order', compact('orders'));
    }

    public function PendingOrder()
    {
        $orders = Order::where('status','pending')->with(['user','address'])->orderBy('id','desc')->get();
        return view('admin.order.pending-order', compact('orders'));
    }

    public function ProcessingOrder()
    {
        $orders = Order::where('status','processing')->with(['user','address'])->orderBy('id','desc')->get();
        return view('admin.order.processing-order', compact('orders'));
    }

    public function CancelledOrder()
    {
        $orders = Order::where('status','cancelled')->with(['user','address'])->orderBy('id','desc')->get();
        return view('admin.order.cancelled-order', compact('orders'));
    }

    public function OrderSearch(Request $request)
    {
        $query = $request->input('query');
        $orders = Order::where('order_no', 'LIKE', "%{$query}%")
            ->orWhere('created_at', 'LIKE', "%{$query}%")
            ->orWhere('status', 'LIKE', "%{$query}%")
            ->orWhere('payment_status', 'LIKE', "%{$query}%")
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->get();
        return view('admin.order.order-table-body', compact('orders'));
    }

    public function EditOrder($id)
    {
        $order = Order::where('id',$id)->with([
            'user',
            'address',
            'paymentRule',
            'orderList.variant.product',
            'orderList.variant.color',
            'orderList.variant.size',
            'orderList.variant.material',
        ])->first();
        $rules = PaymentRule::all();
        return view('admin.order.edit-order',compact('order','rules'));
    }

    public function UpdateOrder(Request $request)
    {
        $order = Order::findOrFail($request->id)->update([
            'note' => $request->note,
            'payment_rule_id' => $request->payment_rule,
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Order Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('panel.orders')->with($notification);
    }

    public function OrderList($id)
    {
        $lists = OrderList::where('order_id',$id)->with(['user','variant.product.images','order','variant.color','variant.size','variant.material'])->get();
        return $lists;
    }

    public function DeleteOrderList($id)
    {
        $orderItem = OrderList::findOrFail($id);
        $order = Order::findOrFail($orderItem->order_id);
        $orderItem->variant->update([
            'stock' => $orderItem->variant->stock + $orderItem->quantity,
        ]);
        $order->update([
            'total_price' => $order->total_price - $orderItem->total_price,
        ]);
        $orderItem->delete();
        $notification = array(
            'message' => 'Item Deleted Successfully From Order List.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function DeleteOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status === 'pending' || $order->status === 'processing'){
            $notification = array(
                'message' => 'This Order Is In Processing Status Or Pending Status.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $order->delete();
        $notification = array(
            'message' => 'Order Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
