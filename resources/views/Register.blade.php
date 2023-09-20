<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset ('assets/fonts/css/style.css') }}">



  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset ('assets/css/bootstrap.min.css') }}">

  <!-- Style -->
  <link rel="stylesheet" href="{{asset ('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{asset ('assets/css/owl.carousel.min.css') }}">

  <title>Register</title>
</head>

<body>
  <!-- <div class="d-lg-flex half"> -->
  <!-- <div class="contents order-2 order-md-1"> -->

  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-5" id="registerform">
        <div class="mb-4">
          <h3>Let’s Get Started</h3>
          <p class="mb-4">Create an new account</p>
        </div>
        <form action="{{ route('user.register.submit') }}" method="post">
          @csrf
          <div class="form-group first">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}">
            @error('fullname')
            <span class="text-danger">{{ $message }}</span>
            @enderror

          </div>
          <div class="form-group first">
            <label for="email">Your Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
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
          <div class="form-group last mb-3">
            <label for="password_confirmation">Password again</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">

          </div>

          <div class="d-flex mb-5 align-items-center">
            <input type="checkbox" name="checkbox" id="">
            <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
              <input type="checkbox" checked="checked" />
            </label>
            <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>

          </div>

          <input type="submit" value="Sign Up" class="btn btn-block btn-primary">
          <span class="d-block text-center my-4 text-muted"><a href="login">Have a account? Sign In</a></span>
          <!-- <span class="d-block text-center my-4 text-muted">Have a account? Sign In</span> -->
        </form>
      </div>
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