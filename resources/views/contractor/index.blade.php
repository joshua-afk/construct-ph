@extends('layouts.guest_app')

@section('content')
{{-- Nav --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav m-auto d-block text-center">
			<form action="/search/contractors" method="post" id="searchContractorForm">
				@csrf
				<li class="nav-item d-inline-block float-none mr-2">
					<select class="form-control select2-contractors" name="code" required="required">
						<option></option>
						{{-- @foreach ($companies_list as $company) --}}
						@foreach ($companies_names as $company)
						<option value="{{ $company->code }}">{{ $company->company_name }}</option>
						@endforeach
					</select>
				</li>
				<li class="nav-item d-inline-block float-none mr-2">
					<button class="btn -lime" type="submit" onclick="document.getElementById('searchContractorForm')">
						<i class="fas fa-search"></i>&ensp;Search
					</button>
					@if (Request::is('sort/contractors') || Request::is('search/contractors'))
						<a class="btn -red" href="/contractors"><i class="fas fa-times"></i>&ensp;Clear</a>
					@else
					<button class="btn -blue" type="button" data-toggle="modal" data-target="#sortModal">
						<i class="fas fa-sort"></i>&ensp;Sort
					</button>
					@endif
				</li>
			</form>
		</ul>
	</div>
</nav>
{{-- /Nav --}}
{{-- Content --}}
<section class="all-contractors">
	<div class="container">
		<h1 class="all-contractors__title">Our Contractors</h1>
		<div class="all-contractors__header-line"></div>
		<p class="all-contractors__sub-title mb-3">Want to register your company? <a href="/register">Sign up now!</a></p>

		<hr class="cstm-hr">

		@if (!is_null($companies_list))
		<div class="row">
			@foreach ($companies_list as $contractor)
			<div class="col-md-4 cstm-mb-2">
				<div class="card -shadow-dynamic" style="border-radius: 15px;">
					@if (!is_null($contractor->image))
					<img src="/storage/images/companies/{{ $contractor->image }}" alt="{{ $contractor->image }}" class="card-img-top img--responsive" style="border-top-left-radius: calc(15px - 1px); border-top-right-radius: calc(15px - 1px);">
					@else
					<img src="/storage/images/no-image.jpg" alt="no-image" class="card-img-top img--responsive" style="border-top-left-radius: calc(15px - 1px); border-top-right-radius: calc(15px - 1px);">
					@endif

					<div class="card-body">
						<div class="all-contractors__card-title">
							<h5 class="card-title">{{ $contractor->company_name }}</h5>
						</div>
						<hr class="cstm-hr">
						<div class="all-contractors__card-text">
							<p class="card-text">
								<strong>Catergory:</strong>
								{{ $contractor->category }}
							</p>
							<p class="card-text">
								<strong>PCAB License:</strong>
								{{ ($contractor->pcab_license != null) ? $contractor->pcab_license : 'No data to show->' }}
							</p>
							<p class="card-text">
								<strong>Region:</strong>
								No data to show.
								{{-- {{ ($contractor->region != null) ? $contractor->region->name : 'No data to show.' }} --}}
							</p>
						</div>
						<hr>
						<a class="btn -lime-outline btn-block" href="/companies/{{ $contractor->code }}">
							View Company
						</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@else
		<h2 class="mt-5 text-center">Ooops! There is no data to show.</h2>
		@endif
	</div>
</section>
{{-- Content --}}
@endsection

@push('modal')
<div class="modal fade" id="sortModal" role="dialog" aria-labelledby="sortModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="sortModalLabel">Sort Contractors</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="/sort/contractors" method="post" id="sortContractorsForm">
					@csrf

					<div class="form-group">
						<label class="fw-bold">PCAB Catergory</label>
						<select class="form-control select2-category" name="category">
							<option></option>
							<option value="N/A">N/A</option>
							<option value="E">E (Trade)</option>
							<option value="D">D</option>
							<option value="C">C</option>
							<option value="B">B</option>
							<option value="A">A</option>
							<option value="AA">AA</option>
							<option value="AAA">AAA</option>
							<option value="AAAA">AAAA</option>
						</select>
						@error('category') @alert() {{ $message }} @endalert @enderror
					</div>
				
					<div class="form-group">
						<label class="fw-bold">Location</label>
						<select name="location" class="form-control select2-location">
							<option></option>
							@foreach ($regions as $region)
							<option value="{{ $region->id }}">{{ $region->code.' - '.$region->name }}</option>
							@endforeach
						</select>
						@error('location') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-group">
						<label class="fw-bold">Classification</label>
						<select class="form-control select2-classification" name="classification">
							<option></option>
							@foreach ($companies_list as $company)
							<option value="{{ $company->id }}">{{ $company->company_name }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label class="fw-bold">Pricing Range</label>
						<input
							class="form-control @error('range') is-invalid @enderror"
							type="number"
							name="range"
							value="{{ old('range') }}"
							min="0">
						@error('range') @alert() {{ message }} @endalert @enderror
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn -back" type="button" data-dismiss="modal">Go back</button>
				<button class="btn -submit" type="submit" onclick="document.getElementById('sortContractorsForm').submit()">Sort</button>
			</div>
		</div>
	</div>
</div>
@endpush

@section('scripts')
<script>
	$(document).ready(function() {
		$(".select2-contractors").select2({
			placeholder: "Select contractor",
			allowClear: true
		});

		$(".select2-category").select2({
			placeholder: "Category",
			width: '100%',
			allowClear: true
		});

		$(".select2-location").select2({
			placeholder: "Location",
			width: '100%',
			allowClear: true
		});

		$(".select2-classification").select2({
			placeholder: "Classification",
			allowClear: true,
			width: '100%',
			sortResults: data => data.sort((a, b) => a.text.localeCompare(b.text)),
		});

		$(".select2-specialization").select2({
			placeholder: "Specialization",
			allowClear: true
		});
	});
</script>
@endsection