<body>
    @include('Seller.header')
    <div class="product-section">
        <div class="container">
            <div class="row">
                @foreach($favorites as $favorite)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="#">
                        <img style="height: 100px; width:200px" src="{{ $favorite->product->image[0] }}" class="img-fluid" alt="{{ $favorite->product->id }}">
                        <p><b>{{ $favorite->product->product_name }}</b></p>
                        <p><b>${{ $favorite->product->price }}</b></p>
                        <p><b>${{ $favorite->product->description }}</b></p>
                        <button class="btn btn-danger remove-from-wishlist" data-product-id="{{ $favorite->product->id }}">
                            Remove from Wishlist
                        </button>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('Seller.footer')
</body>