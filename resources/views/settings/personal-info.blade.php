@extends('layouts.app')

@section('content')
<div class="container py-5">
	<div class="row">
		{{-- Sidebar --}}
		<div class="col-3">
			@include('settings.sidebar')
		</div>
		{{-- / Sidebar --}}
		{{-- Main Contents --}}
		<div class="col-9">
			{{-- Pensonal Info --}}
			<div class="panel mb-4">
				<div class="panel__header">
					<h2 class="panel__title">Personal Info</h2>
					<div class="panel__header-line"></div>
				</div>

				<div class="panel__body">
					<form action="/settings/personal-info" method="post">
						<div class="w-75">
							@csrf
							@method('put')

							<div class="form-row form-group">
								<div class="col">
									<label class="fw-bold">Name</label>
									<input
										class="form-control @error('first_name') is-invalid @enderror"
										type="text"
										name="first_name"
										value="{{ $user->first_name }}">
									@error('first_name') @alert() {{ $message }} @endalert @enderror
								</div>
								<div class="col">
									<label class="fw-bold">&nbsp;</label>
									<input
										class="form-control @error('last_name') is-invalid @enderror"
										type="text"
										name="last_name"
										value="{{ $user->last_name }}">
									@error('last_name') @alert() {{ $message }} @endalert @enderror
								</div>
							</div>

							<div class="form-row form-group">
								<div class="col-8">
									<label class="fw-bold">Username</label>
									<input
										class="form-control @error('username') is-invalid @enderror"
										type="text"
										name="username"
										value="{{ $user->username }}">
									@error('username') @alert() {{ $message }} @endalert @enderror
								</div>
								<div class="col-4">
									<label class="-bold" for="birthdate">Birthdate</label>
									<input class="form-control @error('birthdate') is-invalid @enderror"
										type="text"
										name="birthdate"
										value="{{ $user->birthdate->format('m/d/Y') }}">
									@error('birthdate') @alert {{ $message }} @endalert @enderror
								</div>
							</div>

							<div class="form-group">
								<label class="fw-bold">Email</label>
								<input
									class="form-control @error('email') is-invalid @enderror"
									type="email"
									name="email"
									value="{{ $user->email }}">
								@error('email') @alert() {{ $message }} @endalert @enderror
							</div>

							<div class="form-group mt-4">
								<button class="btn -submit" type="submit">Save</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			{{-- / Personal Info --}}
			{{-- Contacts --}}
			<div class="panel mb-4">
				<div class="panel__header">
					<h2 class="panel__title">Contacts</h2>
					<div class="panel__header-line"></div>
				</div>
				<div class="panel__body">
					<form action="/settings/contact-info" method="post">
						<div class="w-75">
							@csrf
							@method('put')

							<div class="form-row form-group">
								<div class="col">
									<label class="fw-bold">Mobile Number</label>
									<input
										class="form-control @error('mobile_number') is-invalid @enderror"
										type="number"
										name="mobile_number"
										value="{{ $user->mobile_number }}">
									@error('mobile_number') @alert() {{ $message }} @endalert @enderror
								</div>
								<div class="col">
									<label class="fw-bold">Phone Number</label>
									<input
										class="form-control @error('phone_number') is-invalid @enderror"
										type="number"
										name="phone_number"
										value="{{ $user->phone_number }}">
									@error('phone_number') @alert() {{ $message }} @endalert @enderror
								</div>
							</div>

							<div class="form-group">
								<label class="fw-bold">Fax Number</label>
								<input
									class="form-control @error('fax_number') is-invalid @enderror"
									type="text"
									name="fax_number"
									value="{{ old('fax_number') }}">
								@error('fax_number') @alert() {{ $message }} @endalert @enderror
							</div>

							<div class="form-group mt-4">
								<button class="btn -submit" type="submit">Save</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			{{-- / Contacts --}}
			{{-- Address --}}
			<div class="panel mb-4">
				<div class="panel__header">
					<h2 class="panel__title">
						Address
						{{-- <button class="btn -lime float-right"><i class="fas fa-plus"></i>&ensp;Add</button> --}}
					</h2>
					<div class="panel__header-line"></div>
				</div>
				<div class="panel__body">
					<form action="/settings/address" method="post">
						<div class="w-75">
							@csrf
							@method('PUT')
							<div class="form-group">
								<label class="fw-bold">Region</label>
								<select class="form-control select2-region" name="region_id">
									@if ($user->region !== null)
										<option value="{{ $user->region->id }}">{{ $user->region->code.' - '.$user->region->name }}</option>
									@else
										<option></option>
									@endif
									@foreach ($regions as $region)
										<option value="{{ $region->id }}">{{ $region->code.' - '.$region->name }}</option>
									@endforeach
								</select>
								@error('region_id') @alert() {{ $message }} @endalert @enderror				
							</div>

							<div class="form-row">
								<div class="col">
									<div class="form-group">
										<label class="fw-bold">City / Municipality</label>
										<select class="form-control select2-city" name="city_id">
											@if ($user->city !== null)
												<option value="{{ $user->city->id }}">{{ $user->city->name }}</option>
											@else
												<option></option>
											@endif
											@foreach ($cities as $city)
												<option value="{{ $city->id }}">{{ $city->name }}</option>
											@endforeach
										</select>
										@error('city_id') @alert() {{ $message }} @endalert @enderror				
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label class="fw-bold">Zip code</label>
										<input
											class="form-control @error('zip') is-invalid @enderror"
											type="number"
											name="zip"
											value="{{ $user->zip }}">
										@error('zip') @alert() {{ $message }} @endalert @enderror
									</div>
								</div>
							</div>

							<div class="form-group">
								<button class="btn -submit" type="submit">Save</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			{{-- / Address --}}
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
	$(function() {
		$('input[name="birthdate"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 1901,
			maxYear: parseInt(moment().format('YYYY'),10)
		});
	});

	$(".select2-city").select2({
		placeholder: "City / Municipality",
		width: '100%',
	});

	$(".select2-region").select2({
		placeholder: "Region",
		width: '100%',
	});
</script>
@endpush