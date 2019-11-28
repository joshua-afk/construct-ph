@extends('layouts.app')
@php $page = 'create_company' @endphp

@section('styles')
<style>
	.panel i::before {
		font-size: 12rem;
		background: -webkit-linear-gradient(#000410, #A7CB00);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
	}

	.col-md-5{
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column;
	}
</style>
@endsection

@section('content')
<div class="container py-5">
	<div class="panel w-75 mx-auto">
		<div class="panel__header">
			<h2 class="panel__title">Create a Company</h2>
			<div class="panel__header-line"></div>
		</div>
		<div class="panel__body">
			<div class="row">
				<div class="col-md-7">
					<form method="post" action="/companies">
						@csrf
						<div class="form-row form-group">
							<div class="col-md-7">
								<select name="type" class="form-control select2-type" required>
									<option value=""></option>
									<option value="contractor">Contractor</option>
									<option value="supplier">Supplier</option>
								</select>								
							</div>
							<div class="col-md-5">
								<select name="category" class="form-control select2-category">
									<option value=""></option>
									<option value="E">E (Trade)</option>
									<option value="D">D</option>
									<option value="C">C</option>
									<option value="B">B</option>
									<option value="A">A</option>
									<option value="AA">AA</option>
									<option value="AAA">AAA</option>
									<option value="AAAA">AAAA</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" placeholder="Company Name" required>
							@if ($errors->has('company_name'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('company_name') }}</strong>
							</span>
							@endif
						</div>

						<div class="form-group">
							<input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="emailHelp" placeholder="E-Mail" required>
							@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@else
							<small id="emailHelp" class="form-text text-muted">Don't use your account email, use different email for the company.</small>
							@endif
						</div>

						<div class="form-row form-group">
							<div class="col">
								<input type="text" class="form-control {{ $errors->has('contact_first_name') ? ' is-invalid' : '' }}" name="contact_first_name" placeholder="First Name" value="{{ $user->first_name }}" required>
								@if ($errors->has('contact_first_name'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('contact_first_name') }}</strong>
								</span>
								@endif
								<small class="form-text text-muted">Contact person name.</small>
							</div>
							<div class="col">
								<input type="text" class="form-control {{ $errors->has('contact_last_name') ? ' is-invalid' : '' }}" name="contact_last_name" placeholder="Last Name" value="{{ $user->last_name }}" required>
								@if ($errors->has('contact_last_name'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('contact_last_name') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('mobile_number') ? ' is-invalid' : '' }}" name="mobile_number" placeholder="Mobile Number (optional)" maxlength="11">
							@if ($errors->has('mobile_number'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('mobile_number') }}</strong>
							</span>
							@endif
						</div>

						<div class="form-group">
							<select name="region" class="form-control select2-region" required>
								<option value=""></option>
								@foreach ($regions as $region)
								<option value="{{ $region->id }}">{{ $region->code.' - '.$region->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-row form-group">
							<div class="col">
								<select name="city" class="form-control select2-city" required>
									<option value=""></option>
									@foreach ($cities as $city)
									<option value="{{ $city->id }}">{{ $city->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col">
								<input type="text" class="form-control {{ $errors->has('zip_code') ? ' is-invalid' : '' }}" name="zip_code" placeholder="ZIP Code" required>
								@if ($errors->has('zip_code'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('zip_code') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('street') ? ' is-invalid' : '' }}" name="street" placeholder="Street, Barangay" required>
							@if ($errors->has('street'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('street') }}</strong>
							</span>
							@endif
						</div>

						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('pcab') ? ' is-invalid' : '' }}" name="pcab" aria-describedby="pcabHelp" placeholder="PCAB" required>
							@if ($errors->has('pcab'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('pcab') }}</strong>
							</span>
							@endif
							<small id="pcabHelp" class="form-text text-muted">Philippine Contractors Accreditation Board License.</small>
						</div>

						<div>
							<button class="btn -submit mr-1">Submit</button>
							<a href="/account/companies" class="btn -back">Go back</a>
						</div>
					</form>
				</div>
				<div class="col-md-5">
					<i class="flaticon-007-buildings"></i>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function()
	{
		$(".select2-type").select2({
			placeholder: "Type of company"
		});

		$(".select2-city").select2({
			placeholder: "City / Municipality"
		});

		$(".select2-region").select2({
			placeholder: "Region"
		});

		$(".select2-category").select2({
			placeholder: "Category",
			allowClear: true
		});
	});
</script>
@endsection