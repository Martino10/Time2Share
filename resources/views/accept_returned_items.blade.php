@extends('dashboard')
<div id="accept_popup" class="popup accept_popup">
    <div class="popup-content">
        <p class="popuptext accept_text"> Your following items have been returned:<br/>  
            @foreach($returned_items as $item)
                {{$item->name}}<br/>
            @endforeach <br/>
            Would you like to accept?
        </p>
        <form id="confirm_acceptform" class="confirmaccept-form" action="{{ route('endloan', ['returned_product_ids' => $product_ids_array, 'id' => Auth::user()->id]) }}" method="POST">
            @csrf  
            <button class="confirm__button" type="submit"> Accept items </button>
        </form>
    </div>
</div>
