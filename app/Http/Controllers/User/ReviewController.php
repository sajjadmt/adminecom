<?php

namespace App\Http\Controllers\User;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function ReviewList(Request $request)
    {
        $result = Review::where('product_id',$request->productId)->with('user')->orderBy('id','desc')->limit(4)->get();
        return $result;
    }

    public function PostReview(Request $request)
    {
        $user = Auth::user();
        $product = $request->productId;
        $rating = $request->rating;
        $comment = $request->comment;

        try {
            $result = Review::create([
                'product_id' => $product,
                'user_id' => $user->id,
                'rating' => $rating,
                'comment' => $comment,
            ]);
            return response([
                'message' => 'Done'
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

    public function Reviews()
    {
        $reviews = Review::with(['user','product'])->orderBy('id', 'desc')->get();
        return view('admin.review.all-review', compact('reviews'));
    }

    public function ReviewSearch(Request $request)
    {
        $query = $request->input('query');
        $reviews = Review::where('comment', 'LIKE', "%{$query}%")
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->get();
        return view('admin.review.review-table-body', compact('reviews'));
    }

    public function ReviewToggleStatus(Request $request)
    {
        $review = Review::findOrFail($request->id);
        $review->status = $review->status === 'approved' ? 'rejected' : 'approved';
        $review->save();
        return response()->json(['status' => $review->status]);
    }

    public function EditReview($id)
    {
        $review = Review::where('id',$id)->with(['user','product'])->first();
        return view('admin.review.edit-review',compact('review'));
    }

    public function UpdateReview(Request $request)
    {
        $review = Review::findOrFail($request->id);
        if ($review){
            $review->update([
                'comment' => $request->comment,
                'rating' => $request->rating,
                'status' => $request->status,
            ]);
            $notification = array(
                'message' => 'Review Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('panel.reviews')->with($notification);
        }
    }

    public function DeleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        $notification = array(
            'message' => 'Review Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
