<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function ReviewList(Request $request)
    {
        $productId = $request->product_id;
        $reviewList = ProductReview::where('product_id',$productId)->orderBy('id','desc')->limit(3)->get();
        return $reviewList;
    }
}
