@extends('default')
@section('title')
   {{$user->username}}'s profile
@endsection
@section('content')
    @include('layouts.navigation')
    <section class="userprofile">
        <h2 class="userprofile__header"> {{ $user->username }} </h2>
        <figure class="userprofile__frame">
            <img class="userprofile__image" src="{{ $user->picture }}">
        </figure>
        <div class="userprofile__rating"> {{ $user->rating }}</div>
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
            <div class="userprofile__info--row">
                <p>Member since</p><p class="datarow">{{ date('d-m-Y', strtotime($user->created_at)) }}</p>
            </div>
        </form>
    </section>
    <script type="text/javascript">
        function setReviewStars(ratings) {
            for (let i = 0; i < ratings.length; i++) {
                var rating = ratings[i].innerHTML;
                ratings[i].innerHTML = '';
                var fullStars = Math.floor(rating);
                var midStarFilling = Math.round((rating % 1) * 100 * 10) / 10;
                var emptyStars = 5 - Math.ceil(rating);

                var fullStar = `<span class="fa fa-star star_rating fullStar"></span>`;
                var emptyStar = `<span class="fa fa-star star_rating emptyStar"></span>`;
                if (midStarFilling > 0) {
                    ratings[i].innerHTML = `${fullStar.repeat(fullStars)}` + `<span class="fa fa-star star_rating midwayStar"></span>` + `${emptyStar.repeat(emptyStars)}`;
                    var midwayStars = document.getElementsByClassName('midwayStar');
                    for (let i = 0; i < midwayStars.length; i++) {
                        var gradient = `linear-gradient(to right, rgb(59 130 246) 0% ${midStarFilling}%, #7a7a7a ${midStarFilling}%)`;
                        midwayStars[i].style.setProperty('--transparent', 'transparent');
                        midwayStars[i].style.setProperty('--gradient', gradient);
                    }
                } else {
                    ratings[i].innerHTML = `${fullStar.repeat(fullStars)}` + `${emptyStar.repeat(emptyStars)}`;
                }
 
            }
        }
        var userRating = document.getElementsByClassName('userprofile__rating');
        setReviewStars(userRating);
    </script>
@endsection