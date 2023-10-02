<body>
    @include('Seller.header')
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="p-1.5 w-full inline-block align-middle">
                    <div class="overflow-hidden border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.add-to-wishlist').on('click', function() {
                var productId = $(this).data('product-id');

                $.ajax({
                    url: "{{ route('favorite.add', ['id' => ':id']) }}".replace(':id', productId),
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        if (data.message) {
                            toastr.error(data.message);
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
            });
        });
    </script>


    @include('Seller.footer')
</body>