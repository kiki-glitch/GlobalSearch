
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Registration Page</title>

 <!-- Styles -->
 @vite(['resources/css/app.css','resources/js/app.js'])

</head>
<body class="hold-transition register-page">

<div class="register-box">
<div class="register-logo">
<a href="#"><b>Admin</b>LTE</a>
</div>
<div class="card">
    <div class="card-body register-card-body">
    <p class="login-box-msg">Register a new membership</p>
    <form action="{{ route('register') }}" method="post">
        @csrf
    <div class="input-group mb-3">
    <input name="name" id="name" type="text" class="form-control" placeholder="Full name" value="{{ old('name')}}">
    <div class="input-group-append">
    <div class="input-group-text">
    <span class="fas fa-user"></span>
    </div>
    </div>
    </div>
        @error('name')
        <span class="text-red invalid feedback">
                    
                    {{ $message }}
                    
            </span>
        @enderror
    <div class="input-group mb-3">
    <input name="email" id="email" type="email" class="form-control" placeholder="Email" value="{{ old('email')}}">
    <div class="input-group-append">
    <div class="input-group-text">
    <span class="fas fa-envelope"></span>
    </div>
    </div>
    </div>
            @error('email')
            <span class=" text-red invalid feedback">
                    
                    {{ $message }}
                    
            </span>
            @enderror


    <div class="input-group mb-3">
    <input name="password" id="password" type="password" class="form-control" placeholder="Password" value="{{ old('password')}}">
    <div class="input-group-append">
    <div class="input-group-text">
    <span class="fas fa-lock"></span>
    </div>
    </div>
    </div>
        @error('password')
            <span class="text-red invalid feedback">
                        
                {{ $message }}
                        
            </span>
        @enderror
    <div class="input-group mb-3">
    <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="Retype password" value="">
    <div class="input-group-append">
    <div class="input-group-text">
    <span class="fas fa-lock"></span>
    </div>
    </div>
    </div>
            @error('password_confirmation')
            <span class="invalid feedback">
                    
                    {{ $message }}
                    
            </span>
            @enderror
    <div class="row">
    <div class="col-8">
    <div class="icheck-primary">
    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
    <label for="agreeTerms">
    I agree to the <a href="#">terms</a>
    </label>
    </div>
    </div>

    <div class="col-4">
    <button type="submit" class="btn btn-primary btn-block">Register</button>
</div>


</div>
</form>

    <div class="social-auth-links text-center">
    <p>- OR -</p>
    <a href="#" class="btn btn-block btn-primary">
    <i class="fab fa-facebook mr-2"></i>
    Sign up using Facebook
    </a>
    <a href="#" class="btn btn-block btn-danger">
    <i class="fab fa-google-plus mr-2"></i>
    Sign up using Google+
    </a>
    </div>

<a href="/" class="text-center">I already have a membership</a>

</div>



</div>

<router-view></router-view>
</div>

</body>
</html>
