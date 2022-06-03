<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use \App\Models\User;
use \App\Models\Product;
use \App\Models\Loan;
use \App\Models\Review;

class UserController extends Controller
{
    public function show($id) {
        $reviews = Review::join('users', 'reviews.reviewer_id','=','users.id')->where('user_id','=',$id)->get();

        // get user rating
        $user = User::find($id);
        $user_rating = Review::where('user_id','=', $id)->avg('review_rating');
        if ($user_rating != null) {
            $user->update(['rating' => $user_rating]);
        }

        return view('profile.show', [
            'user' => $user,
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
                'user' => User::find($id),
                'returned_items' => $returned_items,
                'product_ids_array' => $product_ids,
            ]);
        }
        return view('dashboard', [
            'user' => User::find($id),
        ]);
    }

    public function update(Request $request, $id) {
        $user = User::where('id','=', $id);
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

    public function admin($id) {
        $users = User::where('admin','=','0')->get();
        return view('admin.adminpage', [
            'users' => $users,
        ]);
    }

    public function blockuser($id) {
        $user = User::where('id','=', $id);
        $user->update(['blocked' => 1]);

        $users = User::where('admin','=','0')->get();

        return redirect()->route('adminpage', [
            'id' => Auth::user()->id,
        ]);
    }

    public function unblockuser($id) {
        $user = User::where('id','=', $id);
        $user->update(['blocked' => 0]);

        $users = User::where('admin','=','0')->get();

        return redirect()->route('adminpage', [
            'id' => Auth::user()->id,
        ]);
    }

    public function banuser($id) {
        $user = User::where('id','=', $id);
        $userproducts = Product::where('owner_id','=', $id);
        $userreviews = Review::where('reviewer_id','=', $id)->orWhere('user_id','=', $id);

        $userreviews->delete();
        $userproducts->delete();
        $user->delete();

        $users = User::where('admin','=','0')->get();
        return redirect()->route('adminpage', [
            'id' => Auth::user()->id,
        ]);
    }

    public function search(Request $request) {
        $q = $request['q'];
        $user = User::where('username','LIKE','%'.$q.'%')->get();

        if(count($user) > 0) {
            return view('admin.adminpage', [
                'users' => $user,
            ]);
        }
            
        else {
            return redirect()->route('adminpage', [
                'id' => Auth::user()->id,
            ]);
        }

    }
}
