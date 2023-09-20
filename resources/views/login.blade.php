<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{asset ('assets/fonts/style.css') }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset ('assets/css/bootstrap.min.css') }}">
  <!-- Style -->
  <link rel="stylesheet" href="{{asset ('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{asset ('assets/css/owl.carousel.min.css') }}">

  <title>Login</title>
</head>

<body>
  <!-- <div class="d-lg-flex half"> -->
  <!-- <div class="contents order-2 order-md-1"> -->

  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-5" id="loginform">
        <div class="mb-4">
          <h3>Welcome to Swappsies</h3>
          <p class="mb-4">Sign in to continue</p>
        </div>
        <form action="{{ route('user.login.submit') }}" method="post">
          @csrf
          <div class="form-group first">
            <label for="email">My Email</label>
            <input type="text" class="form-control" id="email" name="email">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group last mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="d-flex mb-5 align-items-center">
            <input type="checkbox" name="checkbox" id="">
            <label class="control control--checkbox mb-0"><span class="">Remember me</span>
              <input type="checkbox" checked="checked" />
              <!-- <div class="control__indicator"></div> -->
            </label>
            <span class="ml-auto"><a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password</a></span>
          </div>

          <input type="submit" value="Log In" class="btn btn-block btn-primary">

          <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>

          <div class="social-login">
            <a href="{{ url('auth/google') }}" class="google btn d-flex justify-content-center align-items-center">
              <i class="fa-brands fa-google"></i>Login with Google
            </a>

            <a href="#" class="facebook btn d-flex justify-content-center align-items-center">
              <i class="fa-brands fa-apple"></i>Login with Apple ID
            </a>

            <!-- <span class="d-block text-center my-4 text-muted"><a href="register">Don’t have a account? Register</a></span> -->
            <!-- <span class="d-block text-center my-4 text-muted">Don’t have a account? Register</span> -->
          </div>
          <span class="d-block text-center my-4 text-muted register-text"><a href="register">Don’t have a account? Register</a></span>
        </form>
      </div>
    </div>
  </div>
  <!-- </div> -->
  <!-- </div> -->
  <script src="{{asset ('assets/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{asset ('assets/js/popper.min.js') }}"></script>
  <script src="{{asset ('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{asset ('assets/js/main.js') }}"></script>

</body>

</html>