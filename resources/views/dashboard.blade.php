@extends('default')
@section('title')
   Dashboard
@endsection
@section('content')
    @include('layouts.navigation')
    <h3 class="dashboard--header">Welcome {{ Auth::user()->username }},<br> what would you like to do?</h3>
    <section class="dashboard--buttons">
        <button class="item_out--button" onclick="location.href='{{ route('myproducts', ['id' => Auth::user()->id]) }}'">Lend Item</button><button class="item_in--button" onclick="location.href='{{ route('browseitems', ['id' => Auth::user()->id]) }}'">Find Item</button>
    </section>
@endsection
