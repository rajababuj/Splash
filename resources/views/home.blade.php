<body>
    @include('Seller.header')
    <div class="product-section">
        <div class="container">
            <div class="row">
                @foreach($product as $item)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="{{ route('user.productoffer', $item->id) }}">
                        <img src="{{$item->image[0]}}" class="img-fluid" alt="{{ $item->id }}">
                        <P><b>{{ $item->product_name }}</b></P>
                        <p><b>${{ $item->price }}</b></p>
                        <P>${{ $item->description }}</P>
                        <span class="icon-cross">
                            <img class="img-fluid" src="{{asset('admin-assets/dist/img/cross.svg')}}">
                        </span>
                    </a>
                    <form action="{{ route('favorite.add', $item->id) }}" class="fa fa-heart" aria-hidden="true" method="POST">
                        @csrf
                        <button type="submit" class="p-2 bg-red-100 rounded hover:bg-red-600">

                            <svg src="{{asset('admin-assets/dist/img/cross.svg')}}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-700 hover:text-red-100">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </form>
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