@extends('default')
@section('title')
   {{$user->username}}'s profile
@endsection
@section('content')
    @include('layouts.navigation')
    <section class="userprofile">
        <h2 class="userprofile__header"> {{ $user->username }} </h2><i class="gg-shield" title="Admin" style="display: none"></i>
        <figure class="userprofile__frame">
            <img class="userprofile__image" src="{{ $user->picture }}">
        </figure>
        <div class="userprofile__rating" title="{{ $user->rating }}"> {{ $user->rating }}</div>
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
            <div class="userprofile__info--row">
                <p>Member since</p><p class="datarow">{{ date('d-m-Y', strtotime($user->created_at)) }}</p>
            </div>
            <button class="editbutton" onclick="location.href = editprofileroute"><p>Edit</p> <i class="gg-pen"></i></button>
        </section>
    </section>
    <section class="reviews">
        <form class="reviews__write" id="reviewform" action="{{ route('postreview', ['id' => $user->id]) }}" method="POST">
        @csrf
            <h3 class="reviews__write__header"> Submit a review for {{ $user->username }} </h3>
            <div class="sliders">
                <input type="range" min="1.0" max="5.0" value="1.0" step="0.1" class="slider" name="review_rating">
                <output for="review_rating" onforminput="value = review_rating.valueAsNumber;" class="bubble"></output>
                <div class="star_rating_container">
                    <span class="fa fa-star star_rating submit_star_rating"></span>
                    <span class="fa fa-star star_rating submit_star_rating"></span>
                    <span class="fa fa-star star_rating submit_star_rating"></span>
                    <span class="fa fa-star star_rating submit_star_rating"></span>
                    <span class="fa fa-star star_rating submit_star_rating"></span>
                </div>
            </div>  
            <textarea class="review__textarea" name="review_text" id="review__textarea" placeholder="Write your review here..."></textarea>
            <button class="post-review__button" type="submit"> Submit review </button>
        </form>
        <article class="reviews__written">
            <h3 class="reviews__written__header"> Reviews for {{ $user->username }} </h3>
            @foreach($reviews as $review)
                <div class="review_box">
                    <figure class="reviewer_figure">
                        <img class="reviewer_figure__image" src="{{ $review->picture }}">
                    </figure>
                    <h5 class="reviewer_name">{{ $review->username }}</h5>
                    <p class="review_rating" title="{{ $review->review_rating }}"> {{ $review->review_rating }} </p>
                    <p class="review_text"> {{ $review->review_text }} </p>
                    <p class="review_date"> {{ date('d-m-Y H:i',strtotime($review->posted_at)) }} </p>
                </div>
            @endforeach
            <p class="no_reviews" style="display: none"> There are no reviews for this user yet. </p>
        </article>
    </section>
    <script type="text/javascript">
        // hide edit button on profile if the logged in user is not the profile being shown
        // also hides review form if the logged in user IS the profile being shown
        var editbutton = document.getElementsByClassName("editbutton")[0];
        var write_review = document.getElementsByClassName("reviews__write")[0];
        if ({{ Auth::user()->id }} != {{ $user->id }}) {
            editbutton.style.display = "none";
            
        } else {
            write_review.style.display = "none";
        }

        // shows admin icon when the shown user is an admin
        var admin_icon = document.getElementsByClassName('gg-shield')[0];
        if ({{ $user->admin }}) {
            admin_icon.style.display = '';
        }

        // checks if the user has reviews and shows 'no_reviews' text when they don't
        var reviews_amount = document.getElementsByClassName("review_box").length;
        var no_reviews_text = document.getElementsByClassName("no_reviews")[0];
        if (reviews_amount == 0) {
            no_reviews_text.style.display = "";
        }

        // Star slider on input
        var slider = document.getElementsByClassName("slider")[0];
        var bubble = document.getElementsByClassName("bubble")[0];
        var stars = document.getElementsByClassName("submit_star_rating");
        bubble.style.display = "none";
        slider.addEventListener("input", () => {
            bubble.style.display = "";
            setStars(slider, bubble);
        });

        function setStars(range, bubble) {
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

        // Display star ratings (user and review rating)
        var reviewRatings = document.getElementsByClassName('review_rating');
        var userRating = document.getElementsByClassName('userprofile__rating');
        function setstarRating(ratings) {
            for (let i = 0; i < ratings.length; i++) {
                var rating = ratings[i].innerHTML;
                ratings[i].innerHTML = '';
                var fullStars = Math.floor(rating);
                var midStarFilling = Math.round((rating % 1) * 100 * 10) / 10; // Get decimal number and convert to percentage
                var emptyStars = 5 - Math.ceil(rating);

                var fullStar = `<span class="fa fa-star star_rating fullStar"></span>`;
                var emptyStar = `<span class="fa fa-star star_rating emptyStar"></span>`;
                if (midStarFilling > 0) {
                    ratings[i].innerHTML = `${fullStar.repeat(fullStars)}` + `<span class="fa fa-star star_rating midwayStar"></span>` + `${emptyStar.repeat(emptyStars)}`;

                    var gradient = `linear-gradient(to right, rgb(59 130 246) 0% ${midStarFilling}%, #7a7a7a ${midStarFilling}%)`;
                    var midwayStar = ratings[i].getElementsByClassName('midwayStar')[0];
            
                    midwayStar.style.setProperty('--transparent', 'transparent');
                    midwayStar.style.setProperty('--gradient', gradient);
                    
                } else {
                    ratings[i].innerHTML = `${fullStar.repeat(fullStars)}` + `${emptyStar.repeat(emptyStars)}`;
                }
            }
        }
        setstarRating(userRating);
        setstarRating(reviewRatings);
    </script>
@endsection