<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \App\Models\User;
use Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id) {
        $review->review_rating = $request->input('review_rating');
        $review->review_text = $request->input('review_text');
        $review->reviewer_id = Auth::user()->id;
        $review->user_id = $id;

        $product->save();
        return redirect()->route('profile', ['id' => $id]);
    }
}
