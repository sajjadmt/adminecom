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
        $product = ProductList::where('id', $productId)->first();
        if ($product->special_price === '') {
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

    public function CartCount(Request $request)
    {
        $userId = $request->userId;
        return ProductCart::where('user_id', $userId)->count();
    }

    public function CartList(Request $request)
    {
        $userId = $request->userId;
        $cartList = ProductCart::with('product')->where('user_id', $userId)->get();
        return $cartList;
    }

    public function DeleteCart(Request $request)
    {
        $userId = $request->userId;
        $productId = $request->productId;
        $result = ProductCart::where('user_id', $userId)->where('product_id', $productId)->delete();
        return $result;
    }

    public function QuantityIncrease(Request $request)
    {
        $id = $request->id;
        $item = ProductCart::where('id', $id)->first();
        $product = ProductList::where('id', $item->product_id)->first();
        $price = $product->price;
        $special_price = $product->special_price;
        $newQuantity = $item->quantity + 1;
        if ($special_price === ''){
            $newTotalPrice = $price * $newQuantity;
        }else{
            $newTotalPrice = $special_price * $newQuantity;
        }
        $result = $item->update([
            'quantity' => $newQuantity,
            'total_price' => $newTotalPrice
        ]);
        return $result;
    }

    public function QuantityDecrease(Request $request)
    {
        $id = $request->id;
        $item = ProductCart::where('id', $id)->first();
        $product = ProductList::where('id', $item->product_id)->first();
        $price = $product->price;
        $special_price = $product->special_price;
        $newQuantity = $item->quantity - 1;
        if ($special_price === ''){
            $newTotalPrice = $price * $newQuantity;
        }else{
            $newTotalPrice = $special_price * $newQuantity;
        }
        $result = $item->update([
            'quantity' => $newQuantity,
            'total_price' => $newTotalPrice
        ]);
        return $result;
    }

    public function QuantityIncrease(Request $request)
    {
        $id = $request->id;
        $item = ProductCart::where('id',$id)->first();
        $product = ProductList::where('id',$item->product_id)->first();
        $newQuantity = $item->quantity + 1;
        if ($product->special_price === ''){
            $newTotalPrice = $newQuantity * $product->price;
        }else{
            $newTotalPrice = $newQuantity * $product->special_price;
        }
        $result = $item->update([
            'quantity' => $newQuantity,
            'total_price' => $newTotalPrice
        ]);
        return $result;
    }

    public function QuantityDecrease(Request $request)
    {
        $id = $request->id;
        $item = ProductCart::where('id',$id)->first();
        $product = ProductList::where('id',$item->product_id)->first();
        $newQuantity = $item->quantity - 1;
        if ($product->special_price === ''){
            $newTotalPrice = $newQuantity * $product->price;
        }else{
            $newTotalPrice = $newQuantity * $product->special_price;
        }
        $result = $item->update([
            'quantity' => $newQuantity,
            'total_price' => $newTotalPrice
        ]);
        return $result;
    }

}
