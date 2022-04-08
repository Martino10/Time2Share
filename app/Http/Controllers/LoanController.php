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
        $product = DB::select('select products.*, users.name as owner from products, users where products.id = ? and users.id = products.owner_id',[$product_id])[0];
        return view('products.loan', ['product' => $product]);
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
