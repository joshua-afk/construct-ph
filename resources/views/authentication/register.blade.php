@extends('layouts.guest_app')
@php $page = 'register' @endphp

@section('content')

<section class="auth">
	<div class="auth__container auth__container--register">
		<div class="row">
			<div class="col-md-7">
				<form method="post" action="/register">
					@csrf
					<h3 class="auth__header">Create account</h3>
					<div class="form__header-line"></div>

					<div class="form-group">
						<select name="type" class="form-control select2">
							@if (old('type') == 2)
								s<option value="2" selected>I'm a Client</option>
								<option value="3">I'm a Professional</option>
								<option value="4">I'll create a company</option>
							@elseif (old('type') == 3)
								<option value="2">I'm a Client</option>
								<option value="3" selected>I'm a Professional</option>
								<option value="4">I'll create a company</option>
							@elseif (old('type') == 4)
								<option value="2">I'm a Client</option>
								<option value="3">I'm a Professional</option>
								<option value="4" selected>I'll create a company</option>
							@else
								<option value=""></option>
								<option value="2">I'm a Client</option>
								<option value="3">I'm a Professional</option>
								<option value="4">I'll create a company</option>
							@endif
						</select>
						@error('type')
							@alert()
								{{ $message }}
							@endalert
						@enderror
					</div>

					<div class="form-row form-group">
						<div class="col">
							<input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
							@error('first_name')
								@alert()
									{{ $errors->first('first_name') }}
								@endalert
							@enderror
						</div>
						<div class="col">
							<input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
							@error('last_name')
								@alert()
									{{ $message }}
								@endalert
							@enderror
						</div>
					</div>

					<div class="form-group">
						<input class="form-control @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" placeholder="Username">
						@error('username')
							@alert()
								{{ $errors->first('username') }}
							@endalert
						@enderror
					</div>

					<div class="form-group">
						<input class="form-control @error('email') is-invalid @enderror"  type="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="E-Mail">
						@if ($errors->has('email'))
							@alert()
							{{ $errors->first('email') }}
							@endalert
						@else
							<small class="form-text text-muted" id="emailHelp">We'll never share your email with anyone else.</small>
						@endif
					</div>

					<div class="form-row form-group">
						<div class="col">
							<input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
							@error('password')
								@alert()
									{{ $message }}
								@endalert
							@enderror
						</div>
						<div class="col">
							<input class="form-control @error('re-password') is-invalid @enderror" type="password" name="re-password" placeholder="Confirm Password">
							@error('re-password')
								@alert
									{{ $message }}
								@endalert
							@enderror
						</div>
					</div>

					<div class="form-group">
						<input class="form-control @error('birthdate') is-invalid @enderror" type="text" name="birthdate" value="{{ old('birthdate') }}">
						@error('birthdate')
							@alert
								{{ $message }}
							@endalert
						@enderror
						<small class="form-text text-muted" id="birthdateHelp">Your birthdate.</small>
					</div>

					<div class="form-group">
						<input class="form-control @error('mobile_number') is-invalid @enderror" type="number" id="datepicker" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="Phone Number (optional)" maxlength="11">
						@error('mobile_number')
							@alert
								{{ $message }}
							@endalert
						@enderror
					</div>
					
					<div class="row">
						<div class="col auth__link">
							<a href="/login">I have an account</a>
						</div>
						<div class="col auth__btn">
							<button class="btn -submit">Register</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-5 col-md-5--register">
				<i class="flaticon-020-manufacture"></i>
			</div>
		</div>
	</div>
</section>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		$(".select2").select2({
			placeholder: "Who are you?",
			allowClear: true
		});
	});

	$(function() {
		$('input[name="birthdate"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 1901,
			maxYear: parseInt(moment().format('YYYY'),10)
		});
	});

	// $('form').on('focus', 'input[type=number]', function (e) {
	// 	$(this).on('wheel.disableScroll', function (e) {
	// 		e.preventDefault()
	// 	})
	// })
	// $('form').on('blur', 'input[type=number]', function (e) {
	// 	$(this).off('wheel.disableScroll')
	// })
</script>
@endsection