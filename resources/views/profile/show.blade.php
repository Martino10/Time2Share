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
    <section class="reviews">
        <form class="reviews__write" id="reviewform" action="{{ route('postreview', ['id' => $user->id]) }}" method="POST">
        @csrf
            <h3 class="reviews__write__header"> Submit a review for {{ $user->username }} </h3>
            <label for="rating"> Rating: </label>
            <div class="sliders">
                <input type="range" min="1.0" max="5.0" value="1.0" step="0.1" class="slider" name="review_rating">
                <output for="review_rating" onforminput="value = review_rating.valueAsNumber;" class="bubble"></output>
                <div class="star_rating_container">
                    <span class="fa fa-star star_rating"></span>
                    <span class="fa fa-star star_rating"></span>
                    <span class="fa fa-star star_rating"></span>
                    <span class="fa fa-star star_rating"></span>
                    <span class="fa fa-star star_rating"></span>
                </div>
            </div>  
            <textarea class="review__textarea" name="review_text" id="review__textarea"></textarea>
            <button class="post-review__button" type="submit"> Submit review </button>
        </form>
        <article class="reviews__written">
            @foreach($reviews as $review)
                <div class="review_box">
                    <figure class="reviewer_figure">
                        <img class="reviewer_figure__image" src="{{ $review->picture }}">
                    </figure>
                    <h5 class="reviewer_name">{{ $review->username }}</h5>
                    <p class="review_rating"> {{ $review->review_rating }}&nbsp;<span class="fa fa-star review_stars"></span></p>
                    <p class="review_text"> {{ $review->review_text }} </p>
                    <p class="review_date"> {{ date('d-m-Y h:i',strtotime($review->created_at)) }} </p>
                </div>
            @endforeach
        </article>
    </section>
    <script type="text/javascript">
        // hide edit button on profile if the logged in user is not the profile being shown
        var editbutton = document.getElementsByClassName("editbutton")[0];
        if ({{ Auth::user()->id }} != {{ $user->id }}) {
            editbutton.style.display = "none";
        }

        var slider = document.getElementsByClassName("slider")[0];
        var bubble = document.getElementsByClassName("bubble")[0];
        var stars = document.getElementsByClassName("star_rating");
        bubble.style.display = "none";
        slider.addEventListener("input", () => {
            bubble.style.display = "";
            setBubble(slider, bubble);
        });

        function setBubble(range, bubble) {
            var val = range.value;
            const min = range.min ? range.min : 0;
            const max = range.max ? range.max : 100;
            var newVal = Number(((val - min) * 100) / (max - min));
            bubble.innerHTML = val;

            // Sorta magic numbers based on size of the native UI thumb
            bubble.style.left = newVal = "%";

            // Change stars
            full_stars = [];
            for (let i = 0; i < stars.length; i++) {
                stars[i].style.removeProperty('--transparent');
                stars[i].style.removeProperty('--gradient');
                if (val >= i+1) {
                    stars[i].style.color = "rgb(59 130 246)";
                    full_stars.push(i);
                } else {
                    stars[i].style.color = "#7a7a7a";
                };
            };

            // midway stars
            var midwayStar = full_stars[full_stars.length - 1] + 1;
            var fillAmount = Math.round((val % 1) * 100 * 10) / 10;
            var gradient = `linear-gradient(to right, rgb(59 130 246) 0% ${fillAmount}%, #7a7a7a ${fillAmount}%)`;
            if (stars[midwayStar] != null) {
                stars[midwayStar].style.setProperty('--transparent', 'transparent');
                stars[midwayStar].style.setProperty('--gradient', gradient);
            }
            
        }
    </script>
@endsection