@extends('default')
@section('title')
    {{"Browse Items"}}
@endsection
@section('content')
    @include('layouts.navigation')
    <h3 class="myProducts--header">Browse Items</h3>
    <ul class="products--grid">
        @foreach($products as $product)
            @include('products.components.browse_product-card')
        @endforeach
    </ul>
@endsection