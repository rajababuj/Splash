<!DOCTYPE html>
<html>

<body>
    @include('Seller.header')
    <div class="product-section">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item">
                        @if(count($product->image) > 1)
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-indicators">
                                @foreach($product->image as $key => $image)
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}" aria-label="Slide {{ $key + 1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach($product->image as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ $image }}" class="img-fluid product-thumbnail" alt="Image {{ $key + 1 }}">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        @else
                        <img src="{{ $product->image[0] }}" class="img-fluid product-thumbnail" {{ $product->id }} alt="Product Image">
                        @endif
                        <p><b>${{ $product->price }}</b></p>
                        <h4><b>{{ $product->product_name }}</b></h4>
                        <p>categories</p>
                        <p>Category: {{ $category->name }}</p>
                        <p>Subcategory: {{ $subcategory->name }}</p>
                        <p>Product Type: {{ $productType->name }}</p>
                        <p>Description: {{ $product->description }}</p>
                        <button type="button" class="btn btn-primary" id="suggestSwapButton" data-toggle="modal" data-target="#exampleModal" data-swap-url="{{ route('swap') }}" onclick="loadProducts()">
                            suggest swipe
                        </button>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="height: 400px;" class="modal-body">
                    <div class="container">
                        <div class="row" id="productContainer">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="swapSelectedProduct()" class="btn btn-primary">Continue</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    function loadProducts() {
        console.log('Button clicked!');
        const suggestSwapButton = document.getElementById('suggestSwapButton');
        const swapUrl = suggestSwapButton.getAttribute('data-swap-url');

        fetch(swapUrl)
            .then(response => response.json())
            .then(products => {
                const productContainer = document.getElementById('productContainer');
                productContainer.innerHTML = '';
                products.forEach(product => {
                    const productItem = document.createElement('div');
                    productItem.classList.add('col-12', 'col-md-4', 'col-lg-3', 'mb-5', 'mb-md-0');
                    productItem.innerHTML = `
                        <div class="card">
                            <img src="${product.image[0]}" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                              <h7 class="card-title">${product.product_name}</h7>
                              <p class="card-text">$${product.price}</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="${product.id}" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                select
                                </label>
                            </div>
                        </div>
                    `;
                    productContainer.appendChild(productItem);
                });
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    }

    function swapSelectedProduct() {

        const selectedProduct = document.querySelector('input[name="flexRadioDefault"]:checked');
        if (!selectedProduct) {
            console.log('No product selected.');
            return;
        }
        const productId = selectedProduct.value;
        fetch('{{ route("swap.product") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    productId: productId,
                    parentId: "{{$product->id}}"
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);

                if (data.message === 'Product swapped successfully') {

                    toastr.success('Product swapped successfully.', 'Success');
                    setTimeout(function() {
                        window.location.href = '{{ route("user.swap") }}'
                    }, 30);
                }

            })

            .catch(error => {
                console.error('Error swapping product:', error);

            });
    }
</script>


@include('Seller.footer')