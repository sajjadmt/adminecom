<?php

namespace App\Http\Controllers\User;

use App\Models\Favourtie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavourtieController extends Controller
{

    public function AddToFavourite(Request $request)
    {
        $user = Auth::user();
        $exists = Favourtie::where('user_id',$user->id)->where('product_id',$request->product_id)->exists();
        if ($exists){
            return response([
                'message' => 'This Product Is Already In Your Favourite List',
            ],401);
        }
        try {
            $result = Favourtie::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
            ]);
            return response([
                'message' => 'Successfully Added To Favourite List',
            ],200);
        }catch (\Exception $exception){
            return response([
                'message' => $exception->getMessage(),
            ],401);
        }
        return response([
            'message' => 'Something Wrong'
        ],401);
    }

    public function FavouriteList()
    {
        $user = Auth::user();
        $favourites = Favourtie::where('user_id',$user->id)->with(['product','product.images'])->get();
        return $favourites;
    }

    public function RemoveFavourite(Request $request)
    {
        $user = Auth::user();
        try {
            $result = Favourtie::where('user_id',$user->id)->where('product_id',$request->product_id)->delete();
            return response([
                'message' => 'Item Successfully Deleted',
            ],200);
        }catch (\Exception $exception){
            return response([
                'message' => $exception->getMessage(),
            ],401);
        }
    }

    public function FavouriteState(Request $request)
    {
        $user = Auth::user();
        $exists = Favourtie::where('user_id',$user->id)->where('product_id',$request->product_id)->exists();
        return $exists;
    }

}
