@extends('layouts.guest_app')

@section('styles')
<style>

	h1{
		font-size: 3rem;
		text-align: center;
		font-weight: 600;
		line-height: 1.5;
	}

	.form__header-line{
		margin: 0 auto;
		margin-bottom: 1rem;
	}

	hr.construct__hr{
		margin-top: 1.5rem;
		margin-bottom: 2rem;
		border-top: 2px solid #A7CB00;
	}

	.card{
		border: none !important;
		box-shadow: rgba(57, 73, 76, 0.35) 0px 1px 6px;
		transition: box-shadow 0.2s ease-in-out, box-shadow 0.2s ease-in;
	}

	.card:hover{
		box-shadow: rgba(57, 73, 76, 0.4) 0px 2px 10px 1px, rgba(57, 73, 76, 0.25) 0px 1px 2px !important;
	}

	.card-body{
		padding: 10px 20px 1rem 20px;
	}

	.professional__name{
		font-weight: 600;
		margin-bottom: 0;
	}

	.professional__profession{
		text-align: center;
		color: #777777;
	}

	.professional__name,
	.professional__rating{
		text-align: center;
	}

	.professional__star{
		color: #FFC000;
	}

	.fa-star,
	.fa-star-half-alt{
		font-size: 20px !important;
	}

	.professional__reviews{
		color: #777777;
	}

	.form__header-line{
		margin-bottom: 1rem;
	}

	.card__img{
		height: 100px;
		width: 100px;
		margin: 1.5rem auto 0.5rem auto;
	}

	.card__img img{
		border: 4px solid rgb(0, 0, 0, 0.07);
		border-radius: 50%;
		height: 100%;
		width: 100%;
	}

	.search-form{
		margin-bottom: 1.5rem;
	}

	.select2-search__field{
		padding: 0 5px !important;
		width: 100% !important;
	}

	.select2-selection.select2-selection--multiple{
		border-top-right-radius: 0;
		border-bottom-right-radius: 0;
		border: 1px solid #ced4da;
	}
	.select2-selection.select2-selection--multiple:active,
	.select2-selection.select2-selection--multiple:focus{
		border: 1px solid #ced4da;
	}

	.input-group-prepend div{
		height: 100%;
		border-radius: unset;
		border-top-right-radius: 0.25rem;
		border-bottom-right-radius: 0.25rem;
	}

	.btn.btn-primary{
		padding: 9px 12px;
	}

	span.professional-specialty{
		background-color: rgb(224, 224, 224);
		color: rgb(34, 34, 34);
		padding: 5px 10px;
		border-radius: 5px;
		font-size: 14px;
		margin-right: 4px;
		transition: all 0.15s ease 0s;
		cursor: pointer;
	}

	span.professional-specialty:hover{
		background-color: #A7CB00;
		color: #ffffff;
	}
</style>
@endsection
@section('content')
{{-- Nav --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav m-auto d-block text-center">
			<form action="/sort/professionals" method="post">
				@csrf
				{{-- Expertise / Trade --}}
				<li class="nav-item d-inline-block float-none">
					<select name="classification" class="form-control select2-classification">
						<option value=""></option>
						@foreach ($classifications as $classification)
						<option value="{{ $classification->id }}">{{ $classification->name }}</option>
						@endforeach
					</select>
				</li>
				{{-- Location --}}
				<li class="nav-item d-inline-block float-none">
					<select name="location" class="form-control select2-location">
						<option value=""></option>
						@foreach ($regions as $region)
						<option value="{{ $region->id }}">{{ $region->code.' - '.$region->name }}</option>
						@endforeach
					</select>
				</li>
				{{-- Experience / No of completed projects --}}
				<li class="nav-item d-inline-block float-none">
					<input class="form-control" type="number" name="project_count" placeholder="Completed projects">
				</li>
				{{-- Rates --}}
				<li class="nav-item d-inline-block float-none">
					<input class="form-control" type="number" name="rate" placeholder="Rate">
				</li>
				<li class="nav-item d-inline-block float-none ml-3">
					<button class="btn -lime">
						<i class="fas fa-sort"></i>&ensp;Sort
					</button>
					@if (Request::is('sort/professionals'))
						<a class="btn -red" href="/professionals"><i class="fas fa-times"></i>&ensp;Clear</a>
					@endif
				</li>
			</form>
		</ul>
	</div>
</nav>
{{-- / Nav --}}
{{-- Content --}}
<section class="all-contractors">
	<div class="container">
		<h1 class="all-contractors__title">Our Professionals</h1>
		<div class="all-contractors__header-line"></div>
		<p class="all-contractors__sub-title mb-3">Want to register as professional? <a href="/register">Sign up now!</a></p>

		<hr class="cstm-hr">

		<div class="row">
		@forelse($professionals as $professional)
			<div class="col-md-3">
				<div class="card professional-container">
					<div class="card__img">
						@if ($professional->image != null)
							<img class="img-responsive" src="/storage/images/profile-images/{{ $professional->image }}" alt="{{ $professional->image }}">
						@else
							<img class="img-responsive" src="/storage/images/profile-images/default.png" alt="Professional Image">
						@endif
					</div>
					<div class="card-body">

						<h4 class="card-title professional__name">{{ $professional->first_name }} {{ $professional->last_name }}</h4>

						@if (!is_null($professional->overview))
							<p class="professional__profession">{{ $professional->classification->name }}</p>
						@else
							<p class="professional__profession">---</p>
						@endif

						<div style="height: 4px; background-color: #A7CB00; width: 2rem; margin: 0 auto; margin-bottom: 1rem; border-radius: 10px"></div>
						<div class="professional__rating mt-3">
							<div class="professional__star">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fas fa-star-half-alt"></i>
							</div>
							<p><b>4.5% Rating</b> | <span class="professional__reviews">21 Reviews</span></p>
						</div>
						<hr>
						<div class="professional__overview" style="height: 86px">
							<h6 style="font-weight: 600; color: #777777; margin-bottom: 5px;">Overview</h6>
							<div>
								@if (is_null($professional->other_classifications))
									<p>No overview to show.</p>
								@else
									@if (!is_null($professional->preference))
										@if ($professional->preference->summary)
											<p >No overview to show.</p>
										@elseif(strlen($professional->preference->summary) < 60)
											<p >{{ $professional->preference->summary }}</p>
										@else
											<p>{{ substr($professional->preference->summary,0,60)."..." }}</p>
										@endif
									@else
										<p>No overview to show.</p>
									@endif
								@endif
							</div>
						</div>
						<div class="professional__specialties" style="height: 55px; line-height: 2.2;">
							<h6 style="font-weight: 600; color: #777777; margin-bottom: 5px;">Classifications</h6>
							<div>
								@if (count($professional->other_classifications) > 1)
									<span class="badge badge-pill badge-light -hvr_green">{{ $professional->other_classifications->first()->classification->name }}</span>
									<span class="badge badge-pill badge-light -hvr_green">+{{ count($professional->other_classifications) -1 }}</span>
								@else
									@if (!is_null($professional->other_classifications))
										@foreach ($professional->other_classifications as $classification)
											<span class="badge badge-pill badge-light -hvr_green">{{ $classification->name }}</span>
										@endforeach
									@endif
								@endif
							</div>
							@if (count($professional->other_classifications) <= 0)
								<span class="badge badge-pill badge-light -hvr_green">No classifications to show</span>
							@endif
						</div>
						<hr>
						<div class="professional__btn text-center mt-3">
							<a href="/count-click/{{ $professional->username}}" class="btn -lime-outline btn-block" onclick="clickForm({{ $professional->id }})">View Profile</a>
						</div>
					</div>
				</div>
				<form class="d-none" method="POST" id="click-form-{{ $professional->id }}" action="/count-click/{{ $professional->username }}">
					@csrf
				</form>
			</div>
		@empty
		<h2 class="mt-5 text-center">Ooops! There is no data to show.</h2>
		@endforelse
		</div>
	</div>
</section>
{{-- / Content --}}



{{-- <all-professionals :search="{{ json_encode($search) }}" :classifications="{{ json_encode($classifications) }}" :professionals="{{ json_encode($professionals) }}"></all-professionals> --}}
@endsection

{{-- @section('scripts')
<script>
	$(document).ready(function(){
		$(".js-select2-tags").select2({
			tags: true,
			tokenSeparators: [',', ' '],
		});
		// Unselect all the chars inside select2 multiple.
		var $eventSelect = $(".js-select2-tags");
		$eventSelect.on("select2:unselect", () => {
			$eventSelect.on("select2:open", () => {
				$(".select2-search__field").val("");
			})
		})
	});
</script>
@endsection --}}

@section('scripts')
<script>
	$(document).ready(function() {

		function clickForm(id){
			event.preventDefault();
			document.getElementById('click-form-' + id).submit();
		}

		$(".select2-location").select2({
			placeholder: "Location",
			allowClear: true
		});

		$(".select2-classification").select2({
			placeholder: "Classification",
			allowClear: true,
			sortResults: data => data.sort((a, b) => a.text.localeCompare(b.text)),
		});

	});
</script>
@endsection