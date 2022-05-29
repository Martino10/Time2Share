@extends('default')
@section('title')
   My Loans
@endsection
@section('content')
    @include('layouts.navigation')
    <h3 class="myProducts--header">Your Loaned Items</h3>
    <ul class="products--grid">
        @foreach($products as $product)
            @include('products.components.loaned_product-card')
        @endforeach
    </ul>
    @foreach($products as $product)
        @include('products.components.return_popup')
    @endforeach
    <div class="returnConfirmationPopup"> 
        <p class="returnConfirmationPopup__text"> returned! </p>
    </div>
    <script type="text/javascript">
        var popups = document.getElementsByClassName('popup');
        var buttons = document.getElementsByClassName('productGridCard__returnsection__button');
        var close = document.getElementsByClassName("close");

        var returned = document.getElementsByClassName('getReturnedValue');
        var returnedText = document.getElementsByClassName('returnedText');     

        for (let i = 0; i < popups.length; i++) {
            if (returned[i].innerHTML == 1) {
                buttons[i].style.display = "none";
                returnedText[i].style.display = "block";
            } else {
                buttons[i].onclick = function () { openpopup(i);};
            }
        }
        
        function openpopup(i) {
            currentPopup = popups[i];
            currentPopup.style.display = "block";
            close[i].onclick = function() {
                currentPopup.style.display = "none";
            };
            window.onclick = function(event) {
                if (event.target == currentPopup) {
                    currentPopup.style.display = "none";
                }
            }
        }

    </script>
@endsection