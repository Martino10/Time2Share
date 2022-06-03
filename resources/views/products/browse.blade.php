@extends('default')
@section('title')
    {{"Browse Items"}}
@endsection
@section('content')
    @include('layouts.navigation')
    <form action="{{ route('searchproducts') }}" method="POST" role="search" class="productsearchbar">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" name="q" placeholder="Search products">
        </div>
    </form>
    <h3 class="myProducts--header">Browse Items</h3>
    <select class="productfilter" name="category" id="category" placeholder="Filter category" onchange="filter()">
        <option value = "" onchange="filter('all')" selected>Filter by category</option>
        @foreach($categories as $category)
            <option value="{{$category->category}}"> {{$category->category}} </option>
        @endforeach
    </select>
    </form>
    <ul class="products--grid">
        @foreach($products as $product)
            @include('products.components.browse_product-card')
        @endforeach
    </ul>
    <script type="text/javascript">
        let products = document.getElementsByTagName('li');
        function filter() {
            let value = document.getElementById('category').value;
            if (value == "") {
                for (let i = 0; i < products.length; i++) {
                    products[i].style.display = '';
                }
            } else {
                for (let i = 0; i < products.length; i++) {
                    console.log(products[i].dataset.category);
                    
                    if (products[i].dataset.category != value.split(' ')[0]) {
                        products[i].style.display = 'none';
                    }
                }
            }
        }
    </script>
@endsection