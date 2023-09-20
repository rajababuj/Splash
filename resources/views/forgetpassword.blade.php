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

    <title>Forget password</title>
</head>
<body>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-5" id="forgetform">
                <div class="mb-4">
                    <p class="mb-4">Forget Password</p>
                </div>
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="form-group first">
                        <label for="email">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="submit" value="Sign Up" class="btn btn-block btn-primary">
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset ('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{asset ('assets/js/popper.min.js') }}"></script>
    <script src="{{asset ('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{asset ('assets/js/main.js') }}"></script>
</body>

</html>