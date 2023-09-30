
<body>
    @include('Seller.header')
    <div class="product-section">
        <div class="container">
            <div class="row">
                @foreach($product as $item)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="#">
                        <img src="{{$item->image[0]}}" class="img-fluid product-thumbnail" {{ $item->id }}>
                        <P><b>{{ $item->product_name }}</b></P>
                        <p><b>${{ $item->price }}</b></p>
                        <P>${{ $item->description }}</P>
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    @include('Seller.footer')

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>