<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \App\Models\Product;
use \App\Models\User;
use \App\Models\Loan;
use Auth;

class LoanController extends Controller
{
    public function loanproduct($product_id) {
        $product = Product::where('id', '=', $product_id)->first();
        $product = DB::select('select products.*, users.username as owner from products, users where products.id = ? and users.id = products.owner_id',[$product_id])[0];
        return view('products.loan', ['product' => $product]);
    }

    public function myloans($id) {
        $loanedProducts = Product::join('loans', 'products.id','=','loans.product_id')->join('users', 'owner_id','=','users.id')->where('loaner_id','=',$id)->get();
        return view('products.myloans', [
            'products' => $loanedProducts,
        ]);
    }

    public function returnloan(Request $request, $id) {
        $input = $request->all();
        $product_id = $input['product_id'];
        Loan::where('product_id','=', $product_id)->update([
            'returned' => true,
            'userreturndate' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        return redirect()->route('myloans', ['id' => $id]);
    }

    public function endloan(Request $request, $id) {
        $input = $request->all();
        $product_ids = $input['returned_product_ids'];
        for ($x = 0; $x < count($product_ids); $x++) {
            Loan::where('product_id','=', $product_ids[$x])->delete();
            Product::where('id','=',$product_ids[$x])->update(['loaned' => 0]);
        }
        return redirect()->route('dashboard', ['id' => $id]);
    }

    public function store(Request $request, $product_id, Loan $loan) {
        $loaner_id = Auth::user()->id;
        $loan->loaner_id = $loaner_id;
        $loan->product_id = $product_id;
        
        Product::where('id','=',$product_id)->update(array('loaned' => true)); // Set loaned to true for respective product
        
        $input = $request->all();
        $deadline = date("Y-m-d", strtotime($input['deadline']));
        $loan->deadline = $deadline;

        try {
            $loan->save();
            return redirect()->route('browseitems', ['id' => Auth::user()->id]);
        }
        catch(Exception $e) {
            return redirect()->route('loanproduct', ['product_id' => $product_id]);
        }
    }
}
