<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function ReviewList(Request $request)
    {
        $productId = $request->product_id;
        $reviewList = ProductReview::with('user')->where('product_id',$productId)->orderBy('id','desc')->limit(3)->get();
        return $reviewList;
    }

    public function PostReview(Request $request)
    {
        $userId = $request->userId;
        $productId = $request->productId;
        $rating = $request->rating;
        $comment = $request->comment;

        $result = ProductReview::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'reviewer_rating' => $rating,
            'reviewer_comment' => $comment,
        ]);

        return $result;

    }
}
