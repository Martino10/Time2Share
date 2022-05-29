<div id="loan_popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <p class="popuptext">You are about to loan this item: {{$product->name}} from {{$product->owner}}<br>Your deadline to return this item will be on: </p>
        <form id="confirm_loanform" class="confirmloan-form" action="" method="POST">
            @csrf
            <button class="confirm__button" type="submit"> Confirm </button>
        </form>
    </div>
</div>
