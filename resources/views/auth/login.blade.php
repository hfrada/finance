@extends('layouts.app')

<style type="text/css">
	/* Layout Styling */
	* {
		padding: 0;
		margin: 0;
		box-sizing: border-box;
	}

	body {
		background-color: #e0dddd;
	}

	div.container {
		transform: translateY(12.5vh);
	}

	/* Content->Promote Style */
	div div.col-4.bg-info {
		box-shadow: 2.5px 2.5px 7.5px #aaa;
	}

	div div.col-4.bg-info img {
		width: 100%;
		height: 60vh;
	}

	/* Content Style */
	div div.col-5 {
		background: #fff;
		box-shadow: 2.5px 2.5px 7.5px #aaa;
	}

	/* Content->Button Style */
	div div.col-5 div#button button {
		float: right;
		padding: 5px;
	}

	div div.col-5 div#button button:hover a {
		color: #fff;
	}	

	div div.col-5 div#button button a {
		text-decoration: none;
	}

	div div.col-5 div#button button#login {
		padding-right: 7.5px;
		padding-left: 10px;
		border-bottom-right-radius: 0px;
		border-top-right-radius: 0px;
		border-top-left-radius: 15px; 
		border-bottom-left-radius: 15px; 
	}

	div div.col-5 div#button button#register {
		padding-right: 10px;
		padding-left: 7.5px;
		border-bottom-left-radius: 0px;
		border-top-left-radius: 0px;
		border-top-right-radius: 15px; 
		border-bottom-right-radius: 15px; 
	}

	/* Content->Login Style */
	div div.col-5 div#login {
		margin-left: 17.5%;
	}

	div div.col-5 div.inputBox {
		position: relative;
	}

	div.inputBox input {
		width: 80%;
		padding: 10px 0;
		font-size: 16px;
		color: #000;
		margin-bottom: 30px;
		border: none;
		outline: none;
		background: transparent;
	}

	div.inputBox label {
		position: absolute;
		top: 0;
		left: 0;
		padding: 10px 0;
		font-size: 16px;
		color: #000;
		pointer-events: none;
		transition: 0.25s;
	}

	div.inputBox input:focus~label,
	div.inputBox input:valid~label {
		top: -20px;
		left: 0;
		color: #00b0ff;
		font-size: 12px;
		font-weight: bolder;
	}

	div.inputBox span.input {
		position: absolute;
		bottom: 30px;
		left: 0;
		right: 0;
		display: block;
		background: #555;
		width: 80%;
		height: 2px;
	}

	div div.col-5 div.inputBox span.input:before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: #00b0ff;
		transform: scaleX(0);
		transform-origin: right;
		transition: transform 0.25s ease-in-out;
	}

	div div.col-5 div.inputBox input[type="email"]:focus~span.input:before,
	div div.col-5 div.inputBox input[type="email"]:valid~span.input:before,
	div div.col-5 div.inputBox input[type="password"]:focus~span.input:before,
	div div.col-5 div.inputBox input[type="password"]:valid~span.input:before {
		transform: scaleX(1);
		transform-origin: left;
		transition: transform 0.25s ease-in-out;
	}

	/* Content->Footer Style */
	div div.form-check {
		margin-left: 21px;
	}

	div div a.float-right {
		margin-top: -7.5px;
		margin-right: 66px;
	}

	button.btn.btn-primary[type="submit"] {
		width: 80%;
		font-weight: bold;
	}
</style>

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-4 bg-info">
			<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-block w-100" src="a.jpg" alt="First slide">
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="b.jpg" alt="Second slide">
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="c.jpg" alt="Third slide">
					</div>
				</div>
			</div>
		</div>
		<div class="col-5">
			<div id="button" class="pb-5">
				<h2 class="float-left ml-1">Login Account</h2>
				<button class="btn btn-outline-info" id="register"><a href="{{ route('register') }}">Register</a></button>
				<button class="btn btn-outline-info" id="login">Login</button>
			</div>
			<br />
			<div  id="login">
				<form method="POST" action="{{ route('login') }}">
					@csrf

					<div>
						<div class="inputBox">
							<input id="email" type="email" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" required></input>
							<label>{{ __('E-Mail Address') }} @error('email')
			                    <span class="invalid-feedback" role="alert">
			                        <strong>*{{ $message }}</strong>
			                    </span>
			                @enderror</label>
							<span class="input user"></span>
						</div>
						<!-- <div class="mb-2">
							
						</div> -->
						<div class="inputBox">
							<input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" autocomplete="current-password" required></input>
							<label>{{ __('Password') }} @error('password')
			                    <span class="invalid-feedback" role="alert">
			                        <strong>*{{ $message }}</strong>
			                    </span>
			                @enderror</label>
							<span class="input pass"></span>
						</div>
						<!-- <div class="mb-2">
							
						</div> -->
					</div>
					<div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
							<label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
							@if (Route::has('password.request'))
								<a href="{{ route('password.request') }}" class="btn btn-link float-right">{{ __('Forgot Your Password?') }}</a>
							@endif
						</div>
					</div>
					<br />
					<button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection