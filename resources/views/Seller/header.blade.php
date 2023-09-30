<head>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{asset ('admin-assets/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{asset ('admin-assets/dist/css/style.css') }}">
	<link rel="stylesheet" href="{{asset ('admin-assets/dist/css/tiny-slider.css') }}">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- Bootstrap CSS and JavaScript (use appropriate version) -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




</head>
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

	<div class="container">
		<a class="navbar-brand" href="index.html">Furni<span>.</span></a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsFurni">
			<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
				<li class="nav-item active">
					<a class="nav-link" href="{{ route('user.home') }}">Home</a>
				</li>
				<li><a class="nav-link" href="{{ route('user.myproduct') }}">MyProduct</a></li>
				<li><a class="nav-link" href="{{ route('user.about') }}">Account</a></li>
				<li><a class="nav-link" href="{{ route('user.product') }}">Product</a></li>
				<li><a class="nav-link" href="{{ route('user.interests') }}">Interests</a></li>
				<li><a class="nav-link" href="{{ route('user.favorite') }}">Favorite</a></li>
				<li><a class="nav-link" href="{{ route('user.swap') }}">Swaps</a></li>
				<!-- <li><a class="nav-link" href="{{ route('user.productoffer', ['id']) }}">ProductOffer</a></li> -->

			</ul>
			@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
			@endif

			<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
				<li><a class="nav-link" href="{{route('user.logout')}}"><img src="{{asset('admin-assets/dist/img/user.svg')}}"></a></li>
				<li><a class="nav-link" href="{{ route('user.cart') }}"><img src="{{asset('admin-assets/dist/img/cart.svg')}}"></a></li>
			</ul>
		</div>
	</div>
</nav>