<li class="productGridCard" data-category={{$product->category}}>
    <a href="/product/{{$product->id}}">
        <article>
            <header>
                <h2 class="productGridCard__heading"> {{$product->name}} </h2>
            </header>
            <figure class="productGridCard__figure">
                <img class="productGridCard__image" src="{{$product->image}}" alt="{{$product->name}}" />
            </figure>
            <section class="productGridCard__infosection">
                <p>Owner:</p><p class="productGridCard__owner">{{$product->owner}}</p>
                <p>Description:</p><p class="productGridCard__description">{{$product->description}}</p>
                <p>Category:</p><p class="productGridCard__category">{{$product->category}}</p>
                <p>Condition:</p><p class="productGridCard__condition">{{$product->condition}}</p>
            </section>
            <div class="cr cr-bottom cr-right">Loaned out</div>
            <p class="loaned">{{$product->loaned}}</p>
        </article>
    </a>
</li>