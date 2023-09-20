<!-- Start Header/Navigation -->
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
			<li><a class="nav-link" href="{{ route('user.shop') }}">Shop</a></li>
			<li><a class="nav-link" href="{{ route('user.about') }}">About us</a></li>
			<li><a class="nav-link" href="{{ route('user.product') }}">Product</a></li>
			<li><a class="nav-link" href="{{ route('user.interests') }}">Interests</a></li>
			<li><a class="nav-link" href="{{ route('user.contact') }}">Contact us</a></li>
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
<!-- End Header/Navigation -->
