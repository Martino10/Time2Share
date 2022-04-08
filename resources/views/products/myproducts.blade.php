@extends('default')
@section('title')
    {{"My Products"}}
@endsection
@section('content')
    @include('layouts.navigation')
    <h3 class="myProducts--header">Your Lendable Items</h3>
    <ul class="products--grid">
        @foreach($products as $product)
            @include('products.components.product-card')
        @endforeach
        <li class="productGridCard--add">
            <a href="{{route('addproduct', ['id' => Auth::user()->id])}}">
                <article>
                    <header>
                        <h2 class="productGridCard__heading"> Add an Item </h2>
                    </header>
                    <figure class="productGridCard__figure--add">
                        <img class="productGridCard__image" src="/img/plus.png" alt="add product" />
                    </figure>
                </article>
            </a>
        </li>
    </ul>
@endsection