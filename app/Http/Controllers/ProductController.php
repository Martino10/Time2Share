<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \App\Models\Product;
use \App\Models\User;
use \App\Models\Loan;

class ProductController extends Controller
{
    public function myproducts($id) {
        return view('products.myproducts', [
            'products' => Product::where('owner_id','=',$id)->get(),
        ]);
    }

    public function myloans($id) {
        $loanedProducts = Product::join('loans', 'products.id','=','loans.product_id')->join('users', 'owner_id','=','users.id')->get();
        return view('products.myloans', [
            'products' => $loanedProducts,
        ]);
    }

    public function viewproduct($product_id) {
        if (DB::table('loans')->where('product_id', $product_id)->exists()) {
            $product = DB::select('select products.*, users.username as owner, loans.deadline as deadline from products, users, loans where products.id = ? and loans.product_id = ? and users.id = products.owner_id',[$product_id, $product_id])[0];
            $lener = DB::select('select users.name, loans.loaner_id from loans, users where loans.product_id = ? and users.id = loans.loaner_id',[$product_id])[0];
            return view('products.view_loaned', [
                'product' => $product,
                'loaner' => $lener,
            ]);
        }
        else {
            $product = DB::select('select products.*, users.username as owner from products, users where products.id = ? and users.id = products.owner_id',[$product_id])[0];
            return view('products.view', [
                'product' => $product,
            ]);
        }
        
    }

    public function browse($id) {
        $products = DB::select('select products.*, users.username as owner from products, users where products.owner_id = users.id and users.id != ?',[$id]);
        return view('products.browse', [
            'products' => $products,
        ]);
    }

    public function addproduct() {
        $categories = DB::table('category')->get();
        return view('products.add',[
            'categories' => $categories,
        ]);
    }

    public function store(Request $request, Product $product, $id) {

        $imagename = $request->image->getClientOriginalName();
        $imagepath = $request->image->storeAs('img', $imagename ,'public');
        $product->owner_id = $id;
        $product->name = $request->input('name');
        $product->image = '/storage/' . $imagepath;
        $product->category = $request->input('category');
        $product->condition = $request->input('condition');
        $product->description = $request->input('description');

        try {
            $product->save();
            return redirect()->route('myproducts', ['id' => $id]);
        }
        catch(Exception $e) {
            return redirect()->route('addproduct', ['id' => $id]);
        }
    }
}
