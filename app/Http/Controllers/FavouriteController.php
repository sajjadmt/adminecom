<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\ProductList;
use App\Models\User;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function AddToFavourite(Request $request)
    {
        $productDetailsId = $request->productDetailsId;
        $productId = $request->productId;
        $userId = $request->userId;
        $result = Favourite::create([
            'product_details_id' => $productDetailsId,
            'product_id' => $productId,
            'user_id' => $userId,
        ]);
        return $result;
    }

    public function GetFavourite(Request $request)
    {
        $userId = $request->userId;
        $user = User::where('id', $userId)->first();
        $favourites = $user->favourites;
        $products = [];
        foreach ($favourites as $favourite) {
            $product = ProductList::where('id', $favourite->product_id)->first();
            if ($product) {
                $products[] = $product;
            }
        }
        return $products;
    }

    public function DeleteFavourite(Request $request)
    {
        $userId = $request->userId;
        $productId = $request->productId;
        $result = Favourite::where('user_id',$userId)->where('product_id',$productId)->delete();
        return $result;
    }
}
