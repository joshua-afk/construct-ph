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

	<div class="auth__container auth__container--login">
		<form method="post" action="/admin/login">
			@csrf
			<h2 class="auth__header">Login Account</h2>
			<div class="form__header-line"></div>

			@if (session()->has('redirect'))
			<input type="hidden" name="redirect" value="{!! session('redirect') !!}">
			@endif
			
			<div class="form-group">
				<input
					class="form-control @error('username') is-invalid @enderror @if(session()->has('message')) is-invalid @endif"
					type="text"
					name="username"
					placeholder="E-Mail / Username"
					value="{{ old('username') }}"
				>
				@error('username')
					@component('components.error-message')
						{{ $errors->first('username') }}
					@endcomponent
				@enderror
				@if(session('message'))
					@component('components.error-message')
						{{ session('message') }}
					@endcomponent
				@endif
			</div>

			<div class="form-group">
				<input
					class="form-control @error('password') is-invalid @enderror @if(session()->has('message')) is-invalid @endif"
					type="password"
					name="password"
					placeholder="Password"
				>
				@error('password')
					@component('components.error-message')
						{{ $errors->first('password') }}
					@endcomponent
				@enderror
			</div>		

			<div class="form-group">
				<button class="btn -submit">Submit</button>
			</div>
		</form>
	</div>
</section>
@endsection