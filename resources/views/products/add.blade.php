@extends('default')
@section('title')
   Add a Product
@endsection
@section('content')
    @include('layouts.navigation')
    <section class="productprofile">
        <h3 class="productprofile__header"> Add your Item </h3>
        <form id="productform" class="addproduct-form" action="{{ route('storeproduct', ['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <section class="add-product__section">
                <label for="name"> Name </label>
                <input class="add-product__input" name="name" id="name" type="text" />
            </section>
            <section class="add-product__section">
                <label for="image"> Image </label>
                <input class="add-product__input" name="image" id="image" type="file" />
            </section>
            <section class="add-product__section">
                <label for="category"> Category </label>
                <select class="add-product__input" name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{$category->category}}"> {{$category->category}} </option>
                    @endforeach
                </select>
            </section>
            <section class="add-product__section">
                <label for="condition"> Condition </label>
                <select class="add-product__input" name="condition" id="condition">
                    <option value="Nieuw"> Nieuw </option>
                    <option value="Zo goed als nieuw"> Zo goed als nieuw </option>
                    <option value="Gebruikt"> Gebruikt </option>
                </select>
            </section>
            <section class="add-product__section">
                <label for="description"> Description </label>
                <textarea class="add-product__input" name="description" id="description"></textarea>
            </section>
            <button class="add-product__button" type="submit"> Add Item </button>
        </form>
    </section>
@endsection