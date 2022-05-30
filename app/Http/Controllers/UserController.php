<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \App\Models\Product;
use \App\Models\Loan;
use \App\Models\Review;

class UserController extends Controller
{
    public function show($id) {
        $reviews = Review::join('users', 'reviews.reviewer_id','=','users.id')->where('user_id','=',$id)->get();
        // dd($reviews);
        return view('profile.show', [
            'user' => \App\Models\User::find($id),
            'reviews' => $reviews,
        ]);
    }

    public function edit($id) {
        return view('profile.edit', [
            'user' => \App\Models\User::find($id),
        ]);
    }

    public function dashboard($id) {
        $returned_items = Product::join('loans', 'products.id','=','loans.product_id')->where('returned','=',1)->where('owner_id','=',$id)->get();
        if (!$returned_items->isEmpty()) {
            $product_ids = $returned_items->pluck('product_id')->all();
            return view('accept_returned_items', [
                'user' => \App\Models\User::find($id),
                'returned_items' => $returned_items,
                'product_ids_array' => $product_ids,
            ]);
        }
        return view('dashboard', [
            'user' => \App\Models\User::find($id),
        ]);
    }

    public function update(Request $request, $id) {
        $user = \App\Models\User::where('id','=', $id);
        $changableColumns = ['email', 'address', 'place', 'phonenumber'];
        
        try {
            foreach ($changableColumns as $col) {
                if ($request->input($col) != NULL) {
                    $user->update([$col => $request->input($col)]);
                }
            }
            return redirect()->route('profile', ['id' => $id]);
        }
            catch(Exception $e) {
                return redirect()->route('editprofile', ['id' => $id]);
            }
    }
}
