
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Log in</title>

<!-- Styles -->
@vite(['resources/css/app.css','resources/js/app.js'])
 
<body class="hold-transition login-page">
<div class="login-box">
<div class="login-logo">
<a href="#"><b>Admin</b>LTE</a>
</div>

<div class="card">
<div class="card-body login-card-body">
<p class="login-box-msg">Sign in to start your session</p>
<form action="{{ route('login') }}" method="post">
    @csrf
    @if (session('status'))

        <div class="invalid feedback text-red text-center">	
        {{ session('status')}}
        </div>
	@endif
<div class="input-group mb-3">
<input name="email" id="email" type="email" class="form-control" placeholder="Email">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
</div>
        @error('email')
            <span class="text-red invalid feedback">
                        
                {{ $message }}
                        
            </span>
        @enderror
<div class="input-group mb-3">
<input type="password" name="password" id="password" class="form-control" placeholder="Password">
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
<div class="row">
<div class="col-8">
<div class="icheck-primary">
<input type="checkbox" id="remember">
<label for="remember">
Remember Me
</label>
</div>
</div>

<div class="col-4">
<button type="submit" class="btn btn-primary btn-block">Sign In</button>
</div>

</div>
</form>
<div class="social-auth-links text-center mb-3">
    <p>- OR -</p>
    <a href="#" class="btn btn-block btn-primary">
    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
    </a>
    <a href="#" class="btn btn-block btn-danger">
    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
    </a>
</div>

<p class="mb-1">
<a href="#">I forgot my password</a>
</p>
<p class="mb-0">

<a href="/register" class="text-center">Register a new membership</a>
</p>
</div>

</div>


</div>


</body>
</html>
