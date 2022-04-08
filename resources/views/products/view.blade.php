@extends('default')
@section('title')
   View Item
@endsection
@section('content')
    @include('layouts.navigation')
    <article class="productCard" data-product-category={{$product->category}}>
        <header>
            <h2 class="productCard__heading"> {{$product->name}} </h2>
        </header>
        <figure class="productCard__figure">
            <img class="productCard__image" src="{{$product->image}}" alt="{{$product->name}}" />
        </figure>
        <section class="productCard__infosection">
            <section class="productCard__info--row">
                <p>Eigenaar:</p><p class="productCard__owner"><a href="{{ route('profile', ['id' => $product->owner_id]) }}">{{$product->owner}}</a></p>
            </section>
            <section class="productCard__info--row description--row">
                <p>Beschrijving:</p><p class="productCard__description">{{$product->description}}</p>
            </section>
            <section class="productCard__info--row">
                <p>Conditie:</p><p class="productCard__condition">{{$product->condition}}</p>
            </section>
            <section class="productCard__info--row">
                <p>Toegevoegd op:</p><p class="productCard__date_added">{{ date('d-m-Y', strtotime($product->created_at)) }}</p>
            </section>
        </section>
        <button class="loanItem--button" onclick= "location.href = '{{ route('loanproduct', ['product_id' => $product->id]) }}'">Loan this Item</button>
    </article>
    <script type="text/javascript">
        var loanbutton = document.getElementsByClassName('loanItem--button')[0];
        var owner = "{{$product->owner}}";
        var user = "{{ Auth::user()->name }}";
        if (owner == user) {
            loanbutton.style.display = 'none';
        }
    </script>
@endsection