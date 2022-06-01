<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \App\Models\User;
use \App\Models\Review;
use Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function store(Request $request, Review $review, User $user, $id) {
        // get current date
        $date = Carbon::now('Europe/Amsterdam')->toDateTimeString();

        // add review to database
        $review->review_rating = $request->input('review_rating');
        $review->review_text = $request->input('review_text');
        $review->reviewer_id = Auth::user()->id;
        $review->user_id = $id;
        $review->posted_at = $date;
        $review->save();

        // update user rating
        $reviewed_user = User::find($id);
        $new_user_rating = Review::where('user_id','=', $id)->avg('review_rating');
        $reviewed_user->update(['rating' => $new_user_rating]);
        $reviewed_user->save();

        return redirect()->route('profile', ['id' => $id]);
    }
}
