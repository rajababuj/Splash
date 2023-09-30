<body>
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const removeButtons = document.querySelectorAll('.remove-from-wishlist');

            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = button.getAttribute('data-product-id');


                    axios.delete(`/favorite-remove/${productId}`)
                        .then(response => {

                            if (response.data.success) {

                                toastr.success(response.data.message);


                                button.closest('.product-item').remove();
                            } else {

                                toastr.error(response.data.message);
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });
            });
        });
    </script>

    @include('Seller.footer')
</body>