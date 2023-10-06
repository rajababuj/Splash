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
                        <button style="border: 0px;background-color: transparent;" type="submit" onclick="addtoWishlist({{$item->id}})" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                            <span class="bi bi-heart-fill red-color"></span>
                        </button>
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

    <script>
        function addtoWishlist($id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            var url = "{{ route('favorite.add') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    product_id: $id,
                },
                dataType: 'json',
                success: function(data) {
                    if (data.message) {

                        toastr.success(data.message, 'Success');
                    } else {

                        toastr.success('Added to Wishlist successfully', 'Success');
                    }
                    console.log(data);
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message, 'Error');
                    console.log(xhr.responseJSON.message);
                },
            });
        }
    </script>

    @include('Seller.footer')

</body>
<!-- <script>
    function addtoWishlist($id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();


        var url = "{{route('favorite.add')}}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                product_id: $id,
            },
            dataType: 'json',
            success: function(data) {
                if (data.message) {
                    toastr.success(successMessage, 'Success');;
                } else {
                    toastr.success('Added to Wishlist successfully');
                }
                console.log(data);
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON.message);
                console.log(xhr.responseJSON.message);
            },

        });

    }
</script> -->