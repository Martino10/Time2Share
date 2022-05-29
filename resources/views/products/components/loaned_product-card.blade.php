<li class="productGridCard myLoanedItemCard" data-product-category={{$product->category}}>
    <article>
        <a href="/product/{{$product->product_id}}">
            <header>
                <h2 class="productGridCard__heading"> {{$product->name}} </h2>
            </header>
            <figure class="productGridCard__figure">
                <img class="productGridCard__image" src="{{$product->image}}" alt="{{$product->name}}" />
            </figure>
            <section class="productGridCard__infosection">
                <p>Owner:</p><p class="productGridCard__owner">{{$product->username}}</p>
                <p>Description:</p><p class="productGridCard__description">{{$product->description}}</p>
                <p>Condition:</p><p class="productGridCard__condition">{{$product->condition}}</p>
                <p>Return before:</p><p class="productGridCard__deadline">{{ date('d-m-Y', strtotime($product->deadline)) }}</p>
            </section>
        </a>
        <section class="productGridCard__returnsection">
            <button class="productGridCard__returnsection__button"> Return Item </button>
            <p class="returnedText"> Item returned, awaiting confirmation from owner. </p>
        </section>
    </article>
</li>
<p class="getReturnedValue" style="display: none;">{{$product->returned}}</p>