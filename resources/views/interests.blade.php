<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset ('admin-assets/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset ('admin-assets/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{asset ('admin-assets/dist/css/tiny-slider.csss') }}">
    <title>Furni Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co </title>
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="index.html">Furni<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}">Home</a>
                    </li>
                    <li><a class="nav-link" href="{{ route('user.shop') }}">Shop</a></li>
                    <li><a class="nav-link" href="{{ route('user.about') }}">About us</a></li>
                    <li><a class="nav-link" href="{{ route('user.product') }}">Product</a></li>
                    <li class="active"><a class="nav-link" href="{{ route('user.interests') }}">Interests</a></li>
                    <li><a class="nav-link" href="{{ route('user.contact') }}">Contact us</a></li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="{{route('user.logout')}}"><img src="{{asset('admin-assets/dist/img/user.svg')}}"></a></li>
                    <li><a class="nav-link" href="{{ route('user.cart') }}"><img src="{{asset('admin-assets/dist/img/cart.svg')}}"></a></li>
                </ul>
            </div>
        </div>

    </nav>
    <div class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 mb-5">
                    @foreach($category as $item)
                    <div class="post-entry">
                        <a href="#" class="post-thumbnail" style="display: flex; align-items: center;">
                            <img src="{{$item->image}}" class="img-fluid product-thumbnail" style="width: 100px; height: 100px;" alt="{{ $item->id }}">
                        </a>
                        <h4 class="product-title" style="margin-left: 10px;">{{ $item->name }}</h4>
                        <button class="add-interest-button" data-interest-id="{{ $item->id }}">Add Interest</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-interest-button').click(function() {
                var interestId = $(this).data('interest-id');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.add-interest') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'interest_id': interestId
                    },
                    success: function(response) {
                        console.log(response); 
                        alert(response.message);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); 
                        alert('Error adding interest.');
                    }
                });

            });
        });
    </script>
    <!-- End Footer Section -->


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>