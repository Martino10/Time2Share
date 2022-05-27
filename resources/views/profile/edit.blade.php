@extends('default')
@section('title')
   {{$user->name}}'s profile
@endsection
@section('content')
    @include('layouts.navigation')
    <section class="userprofile">
        <h2 class="userprofile__header"> {{ $user->username }} </h2>
        <figure class="userprofile__frame">
            <img class="userprofile__image" src="{{ $user->picture }}">
        </figure>
        <h3 class="userprofile__info--header"> About {{ $user->username }} </h3>
        <form id="profileform" class="editprofile-form">
            @csrf
            <div class="userprofile__info--row">
                <p class="column_name">Email</p><p class="datarow">{{ $user->email }}</p><button class="editrowbutton" onclick="editRow(0, '{{ $user->email }}', updateprofileroute, editprofileroute)"><i class="gg-pen"></i></button>
            </div>
            <div class="userprofile__info--row">
                <p class="column_name">Address</p><p class="datarow">{{ $user->address }}</p><button class="editrowbutton" onclick="editRow(1, '{{ $user->address }}', updateprofileroute, editprofileroute)"><i class="gg-pen"></i></button>
            </div>
            <div class="userprofile__info--row">
                <p class="column_name">Place</p><p class="datarow">{{ $user->place }}</p><button class="editrowbutton" onclick="editRow(2, '{{ $user->place }}', updateprofileroute, editprofileroute)"><i class="gg-pen"></i></button>
            </div>
            <div class="userprofile__info--row">
                <p class="column_name">Phone number</p><p class="datarow">{{ $user->phonenumber }}</p><button class="editrowbutton" onclick="editRow(3, '{{ $user->phonenumber }}', updateprofileroute, editprofileroute)"><i class="gg-pen"></i></button>
            </div>
            <div class="userprofile__info--row">
                <p>Birthday</p><p>{{ date('d-m-Y', strtotime($user->birthday)) }}</p>
            </div>
        </form>
    </section>
@endsection