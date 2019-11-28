@extends('layouts.guest_app')
@php $page = 'login' @endphp

@section('content')
<section class="auth">
	@if (session()->has('login'))
	<div class="alert alert-info" role="alert" style="margin: 0 auto; width: 30rem">
		{!! session('login') !!}
	</div>
	<br>
	@endif
	
	@if (session('registered'))
		@include('components.alert', [
			'class' => 'alert-success mb-3',
			'style' => 'margin: 0 auto; width: 30rem;',
			'slot'  => '<strong>Success!</strong> Account successfully created.'
		])
	@endif

	<div class="auth__container auth__container--login">
		<form method="post" action="/login">
		
			@csrf
			<h2 class="auth__header">Login Account</h2>
			<div class="form__header-line"></div>

			@if (session()->has('redirect'))
			<input type="hidden" name="redirect" value="{!! session('redirect') !!}">
			@endif

			<div class="form-group">
				<input
					class="form-control
					@error('username') is-invalid @enderror
					@if(session()->has('message')) is-invalid @endif"
					type="text"
					name="username"
					placeholder="E-Mail / Username"
					value="{{ old('username') }}"
				>
				@error('username')
					@alert()
						{{ $message }}
					@endalert
				@enderror
				@if(session()->has('message'))
					@alert()
						{{ session('message') }}
					@endalert
				@enderror
			</div>

			<div class="form-group">
				<input
					class="form-control
					@error('password') is-invalid @enderror
					@if(session()->has('message')) is-invalid @endif"
					type="password"
					name="password"
					placeholder="Password"
				>
				@error('password')
					@alert()
					{{ $message }}
					@endalert
				@enderror
			</div>

			<div class="row">
				<div class="col-md-7 auth__link">
					<a href="/register">I don't have an account</a>
				</div>
				<div class="col-md-5 auth__btn">
					<button class="btn -submit">Login</button>
				</div>
			</div>

			<div class="hr-text my-5">
				<span>OR</span>
			</div>
			
			<div class="mb-3" align="center">
				<a href="/login/facebook" class="btn btn-primary btn-lg fb-button">
					<span class="fb-button__icon-container">
						<i class="fab fa-facebook-f fb-button__icon"></i>
					</span>
					<span class="fb-button__text">LOGIN WITH FACEBOOK</span>
				</a>
			</div>

			<div class="mb-3" align="center">
				<a href="/login/google" class="btn btn-danger btn-lg google-button">
					<span class="google-button__icon-container">
						<i class="fab fa-google google-button__icon"></i>
					</span>
					<span class="google-button__text">LOGIN WITH GOOGLE</span>
				</a>
			</div>
		</form>
	</div>
</section>
@endsection