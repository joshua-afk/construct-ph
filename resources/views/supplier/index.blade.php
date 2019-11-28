@extends('layouts.guest_app')
@php $page = 'all_suppliers' @endphp

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav m-auto d-block text-center">
			<form action="/sort/suppliers" method="post">
				@csrf
				<li class="nav-item d-inline-block float-none">
					<select name="category" class="form-control select2-category">
						<option value=""></option>
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
				</li>
				<li class="nav-item d-inline-block float-none">
					<select name="location" class="form-control select2-location">
						<option value=""></option>
						@foreach ($regions as $region)
						<option value="{{ $region->id }}">{{ $region->code.' - '.$region->name }}</option>
						@endforeach
					</select>
				</li>
				<li class="nav-item d-inline-block float-none ml-3">
					<button class="btn -lime"><i class="fas fa-sort"></i>&ensp;Sort</button>
					@if (Request::is('sort/suppliers'))
						<a class="btn -red" href="/suppliers"><i class="fas fa-times"></i>&ensp;Clear</a>
					@endif
				</li>
			</form>
		</ul>
	</div>
</nav>

<section class="all-contractors">
	<div class="container">
		<h1 class="all-contractors__title">Our Suppliers</h1>
		<div class="all-contractors__header-line"></div>
		<p class="all-contractors__sub-title mb-3">Want to register your company? <a href="/register">Sign up now!</a></p>

		<hr class="cstm-hr">

		@if (!is_null($companies_list))
		<div class="row">
			@foreach ($companies_list as $supplier)
			<div class="col-md-4 cstm-mb-2">
				<div class="card -shadow-dynamic">

					@if (!is_null($supplier->image))
						<img src="/storage/images/companies/{{ $supplier->image }}" alt="{{ $supplier->image }}" class="card-img-top img--responsive">
					@else
						<img src="/storage/images/no-image.jpg" alt="no-image" class="card-img-top img--responsive">
					@endif

					<div class="card-body">
						<div class="all-contractors__card-title">
							<h5 class="card-title">{{ $supplier->company_name }}</h5>
						</div>
						<hr class="cstm-hr">
						<div class="all-contractors__card-text">
							<p class="card-text">
								<strong>Catergory:</strong>
								{{ $supplier->category }}
							</p>
							<p class="card-text">
								<strong>PCAB License:</strong>
								{{ ($supplier->pcab_license != null) ? $supplier->pcab_license : 'No data to show->' }}
							</p>
							<p class="card-text">
								<strong>Category:</strong>
								{{ ($supplier->category != null) ? $supplier->category : 'No data to show.' }}
							</p>
							<p class="card-text">
								<strong>Region:</strong>
								{{ ($supplier->region != null) ? $supplier->region : 'No data to show.' }}
							</p>
						</div>

						<hr>

						<a class="btn -lime-outline btn-block" href="/companies/{{ $supplier->code }}">
							View Company
						</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<h2 class="mt-5 text-center">Ooops! There is no data to show.</h2>
		@else
		@endif
	</div>
</section>

{{-- <all-suppliers
	:companies_list="{{ json_encode($companies_list) }}"
	:classifications="{{ json_encode($classifications) }}"
></all-suppliers> --}}
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		$(".select2-category").select2({
			placeholder: "Category",
			allowClear: true
		});

		$(".select2-location").select2({
			placeholder: "Location",
			allowClear: true
		});

		$(".select2-specialization").select2({
			placeholder: "Specialization",
			allowClear: true
		});
	});
</script>
@endsection