@extends('default')
@section('title')
   Loan {{ $product->name }}
@endsection
@section('content')
    @include('layouts.navigation')
    <article class="loanCard">
        <header>
            <h2 class="productCard__heading">Loan {{$product->name}} </h2>
        </header>
        <figure class="loanCard__figure">
            <img class="productCard__image" src="{{$product->image}}" alt="{{$product->name}}" />
        </figure>
        <section class="loanCard__infosection">
            <section class="loanCard__info--row">
                <p>Owner:</p><p class="productCard__owner"><a href="{{ route('profile', ['id' => $product->owner_id]) }}">{{$product->owner}}</a></p>
            </section>
            <section class="loanCard__info--row description--row">
                <p>Description:</p><p class="productCard__description">{{$product->description}}</p>
            </section>
            <section class="loanCard__info--row">
                <p>Condition:</p><p class="productCard__condition">{{$product->condition}}</p>
            </section>
            <section class="loanCard__info--row">
                <p>Added on:</p><p class="productCard__date_added">{{ date('d-m-Y', strtotime($product->created_at)) }}</p>
            </section>
        </section>
        <section class="loanform__section">
            <label for="duration" class="loanform__label"> How long would you like to loan this item for? </label>
            <select class="loanform__select" name="duration" id="duration">
                <option class="duration_option" value="1 Week"> 1 Week </option>
                <option class="duration_option" value="2 Weeks"> 2 Weeks </option>
                <option class="duration_option" value="1 Month"> 1 Month </option>
                <option class="duration_option" value="2 Months"> 2 Months </option>
            </select>
        </section>
        <button class="submit_loan__button" onclick="openpopup()"> Submit Loan </button>
    </article>
    @include('products.components.loan_popup')
    <script type="text/javascript">
        var popup = document.getElementById('loan_popup');
        var button = document.getElementsByClassName('submit_loan__button')[0];
        var close = document.getElementsByClassName("close")[0];
        const select = document.getElementsByClassName('loanform__select')[0];
        var popuptext = document.getElementsByClassName('popuptext')[0];
        var oldPopuptext = popuptext.innerHTML;
        
        function openpopup() {
            popup.style.display = "block";
            var duration = select.options[select.selectedIndex].value;
            var popuptext = document.getElementsByClassName('popuptext')[0];
            switch (duration) {
                case '1 Week':
                    var deadline = moment().add(1, 'w').format('DD-MM-YYYY')
                    popuptext.innerHTML = popuptext.innerHTML + deadline;
                    break;
                case '2 Weeks':
                    var deadline = moment().add(2, 'w').format('DD-MM-YYYY')
                    popuptext.innerHTML = popuptext.innerHTML + deadline;
                    break;
                case '1 Month':
                    var deadline = moment().add(1, 'months').format('DD-MM-YYYY')
                    popuptext.innerHTML = popuptext.innerHTML + deadline;
                    break;
                case '2 Months':
                    var deadline = moment().add(2, 'months').format('DD-MM-YYYY')
                    popuptext.innerHTML = popuptext.innerHTML + deadline;
                    break;
            }
            const form = document.getElementById('confirm_loanform');
            var storeloan_route = "{{ route('storeloan', ['product_id' => $product->id, 'deadline' => 'placeholder']) }}";
            storeloan_route = storeloan_route.replace('placeholder', deadline);
            form.setAttribute("action", storeloan_route);
        }
        close.onclick = function() {
            popup.style.display = "none";
            popuptext.innerHTML = oldPopuptext;
        }
        window.onclick = function(event) {
            if (event.target == popup) {
                popup.style.display = "none";
                popuptext.innerHTML = oldPopuptext;
            }
        }
        
    </script>
@endsection