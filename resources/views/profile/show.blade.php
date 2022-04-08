@extends('default')
@section('title')
   {{$user->name}}'s profile
@endsection
@section('content')
    @include('layouts.navigation')
    <section class="userprofile">
        <h2 class="userprofile__header"> {{ $user->name }} </h2>
        <figure class="userprofile__frame">
            <img class="userprofile__image" src="{{ $user->picture }}">
        </figure>
        <div class="userprofile__rating"> {{ $user->rating }}</div>
        <h3 class="userprofile__info--header"> About {{ $user->name }} </h3>
        <section class="userprofile__info">
            <div class="userprofile__info--row">
                <p>Email</p><p class="datarow">{{ $user->email }}</p>
            </div>
            <div class="userprofile__info--row">
                <p>Address</p><p class="datarow">{{ $user->address }}</p>
            </div>
            <div class="userprofile__info--row">
                <p>Place</p><p class="datarow">{{ $user->place }}</p>
            </div>
            <div class="userprofile__info--row">
                <p>Phone number</p><p class="datarow">{{ $user->phonenumber }}</p>
            </div>
            <div class="userprofile__info--row">
                <p>Birthday</p><p class="datarow">{{ date('d-m-Y', strtotime($user->birthday)) }}</p>
            </div>
            <button class="editbutton" onclick="location.href = editprofileroute">Edit <i class="gg-pen"></i></button>
        </section>
    </section>
    <script type="text/javascript">
        // hide edit button on profile if the logged in user is not the profile being shown
        var editbutton = document.getElementsByClassName("editbutton")[0];
        if ({{ Auth::user()->id }} != {{ $user->id }}) {
            editbutton.style.display = "none";
        }
    </script>
@endsection