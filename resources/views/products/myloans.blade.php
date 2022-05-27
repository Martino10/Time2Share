@extends('default')
@section('title')
   My Loans
@endsection
@section('content')
    @include('layouts.navigation')
    <h3 class="myProducts--header">Your Loaned Items</h3>
    <ul class="products--grid">
        @foreach($products as $product)
            @include('products.components.loaned_product-card')
        @endforeach
    </ul>
@endsection