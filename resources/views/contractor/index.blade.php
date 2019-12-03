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
					<input class="form-control" list="classifications" id="codeInput" style="width: 700px">
					<datalist id="classifications">
						@foreach ($companies_names as $company)
						<option data-value="{{ $company->code }}">{{ $company->company_name }}</option>
						@endforeach
					</datalist>
					<input type="hidden" name="code" id="codeInput-hidden">
				</li>
				<li class="nav-item d-inline-block float-none mr-2">
					<button class="btn -lime" type="submit" onclick="document.getElementById('searchContractorForm')">
						<i class="fas fa-search"></i>&ensp;Search
					</button>
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
		{{-- Sort --}}
		<form action="/sort/contractors" method="post" id="sortContractorsForm">
			@csrf
			<div class="d-flex justify-center mt-3">
				<li class="nav-item d-inline-block float-none mr-1">
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
				</li>
				<li class="nav-item d-inline-block float-none mr-1">
					<select name="location" class="form-control select2-location">
						<option></option>
						@foreach ($regions as $region)
						<option value="{{ $region->id }}">{{ $region->code.' - '.$region->name }}</option>
						@endforeach
					</select>
				</li>
				<li class="nav-item d-inline-block float-none mr-1">
					<select class="form-control select2-classification" name="classification">
						<option></option>
						@foreach ($classifications as $classification)
						<option value="{{ $classification->id }}">{{ $classification->name }}</option>
						@endforeach
					</select>
				</li>
				<li class="nav-item d-inline-block float-none mr-1">
					<input
					class="form-control @error('range') is-invalid @enderror"
					type="number"
					name="range"
					value="{{ old('range') }}"
					placeholder="Pricing range"
					min="0">
				</li>
				<li class="nav-item d-inline-block float-none mr-1">
					<button class="btn -blue" type="submit" onclick="document.getElementById('sortContractorsForm').submit()">Sort</button>
				</li>
				@if (Request::is('sort/contractors'))
				<li class="nav-item d-inline-block float-none">
					<a class="btn -red" href="/contractors">Clear</a>
				</li>
				@endif
			</div>
			</form>
			{{-- Sort --}}
	
		<hr class="cstm-hr">

		@if (Request::is('contractors'))
		<contractors
			:session="{{ json_encode(session()->all()) }}"
		></contractors>	
		@elseif(Request::is('sort/contractors'))
		<!-- Your code hasn't changed-->
		<div id="sortContractors">
			@forelse (array_chunk($companies_list->all(), 3) as $chunk)
			<div class="row">
				@foreach($chunk as $contractor)
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
									@if (session('user_id') !== null)
									{{ ($contractor->region != null) ? $contractor->region->name : 'No data to show.' }}
									@else
									No data to show.
									@endif
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
			@empty
			<h2 class="mt-5 text-center">Ooops! There is no data to show.</h2>
			@endforelse
		</div>
		@endif 

		{{-- Holds page information --}}
		{{-- <input type="hidden" id="page" value="{{ $companies_list->currentPage() }}">
		<input type="hidden" id="max_page" value="{{ $companies_list->lastPage() }}">

		<div id="end_of_page" class="center">
			<hr/>
			<span>You've reached the end of the feed.</span>
		</div> --}}
		{{-- @if (!$companies_list->isEmpty())
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
								@if (session('user_id') !== null)
									{{ ($contractor->region != null) ? $contractor->region->name : 'No data to show.' }}
								@else
									No data to show.
								@endif
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
		@endif --}}
	</div>
</section>
{{-- Content --}}
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

		$(".select2-classification").select2({
			placeholder: "Classification",
			allowClear: true,
			sortResults: data => data.sort((a, b) => a.text.localeCompare(b.text)),
		});

		$(".select2-specialization").select2({
			placeholder: "Specialization",
			allowClear: true
		});
	});

	// Input Datalist
	document.querySelector('input[list]').addEventListener('input', function(e) {
		var input = e.target,
		list = input.getAttribute('list'),
		options = document.querySelectorAll('#' + list + ' option'),
		hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden'),
		inputValue = input.value;

		hiddenInput.value = inputValue;

		for(var i = 0; i < options.length; i++) {
			var option = options[i];

			if(option.innerText === inputValue) {
				hiddenInput.value = option.getAttribute('data-value');
				break;
			}
		}
	});

	// Infinite Scroll
	var outerPane = $('#sortContractors'),
	didScroll = false;

	$(window).scroll(function() {
		didScroll = true;
	});

	//Sets an interval so your window.scroll event doesn't fire constantly. This waits for the user to stop scrolling for not even a second and then fires the pageCountUpdate function (and then the getPost function)
	setInterval(function() {
		if (didScroll){
			didScroll = false;
			if(($(document).height()-$(window).height())-$(window).scrollTop() < 10){
				pageCountUpdate();
			}
		}
	}, 250);

	function pageCountUpdate(){
		var page = parseInt($('#page').val());
		var max_page = parseInt($('#max_page').val());

		if(page < max_page){
			$('#page').val(page+1);
			getPosts();
			$('#end_of_page').hide();
		} else {
			$('#end_of_page').fadeIn();
		}
	}

	//Ajax call to get your new posts
	// function getPosts(){
	// 	$.ajax({
	// 		type: "POST",
 //        url: "/sort/contractors",
 //        data: {
 //        	page: {{-- {{ $companies_list->currentPage() }} --}},
        	
 //        },
 //        beforeSend: function(){ //This is your loading message ADD AN ID
 //        	$('#sortContractors').append("<div id='loading' class='center'>Loading news items...</div>");
 //        },
 //        complete: function(){ //remove the loading message
 //        	$('#loading').remove
 //        },
 //        success: function(html) { // success! YAY!! Add HTML to sortContractors container
 //        	$('#sortContractors').append(html);
 //        	alert('loading');
 //        }
 //      });
	// }
</script>
@endsection