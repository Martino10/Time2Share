<div id="return_popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <p class="popuptext">Are you sure you want to return this item:<br/> {{$product->name}}<br/> to {{$product->username}}?<br>The owner will be notified to accept the item once it's returned. </p>
        <form id="confirm_returnform" class="confirmreturn-form" action="{{ route('returnloan', ['product_id' => $product->product_id, 'id' => Auth::user()->id]) }}" method="POST">
            @csrf
            <button class="confirm__button" type="submit"> Confirm </button>
        </form>
    </div>
</div>