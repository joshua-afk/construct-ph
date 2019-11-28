@extends('layouts.app')

@section('content')
<div class="container pt-5">
	<div class="row mb-5">
		{{-- Left --}}
		<div class="col-md-9">
			<div class="home-search-container">
				<form action="/job/search" method="post">
					@csrf
					<div class="input-group mb-3" style="z-index: 1">
						<input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button class="btn -lime" type="button"><i class="fas fa-search active" aria-hidden="true"></i></button>
						</div>
					</div>
				</form>
			</div>

			<div class="panel">
				<div class="panel__header px-5 pt-4">
					<h2 class="panel__title">Job Posts</h2>
					<div class="panel__header-line"></div>
				</div>
				<ul>
					@if (!$jobs->isEmpty())
						@foreach ($jobs as $job)
							<li class="container-2 -pointer" onclick="jobPostRedirect('{{ $job->code }}')">
								<div class="row pb-1">
									<div class="col-1">
										<div class="container--img-border overflow-hidden rounded-circle" style="height: 50px; width: 50px">
											<img class="img--responsive" src="/storage/images/profile-images/{{ $job->account->image }}" alt="{{ $job->account->username }}">
										</div>
									</div>
									<div class="col-11 pl-2" style="display: flex; align-items: center;">
										<p>
											<a href="/profile/{{ $job->account->username }}">{{ $job->account->first_name.' '.$job->account->last_name }}</a> &#8231; <small class="text-muted">{{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }} at {{ \Carbon\Carbon::parse($job->created_at)->format('g:i A') }}</small>
											<br> <span class="fw-500">Company: </span> {{ $job->company_name }} 
										</p>
									</div>
								</div>
								<h4>{{ $job->title }}</h4>
								<p class="text-muted mb-2">
									<span class="fw-500">Budget:</span> &#8369; {{ $job->salary_min.' - '.$job->salary_max }}
								</p>
								<div class="mb-2">{!! $job->description !!}</div>
								
								<hr>
								<div class="job-post__skills mt-2">
									@if (!$job->job_classifications->isEmpty())
										@foreach ($job->job_classifications as $job_classification)
											<span class="badge badge-pill badge-light -hvr_green">{{ $job_classification->classification->name }}</span>&ensp;
										@endforeach
									@else
										<span class="badge badge-pill badge-light -hvr_green">No classification</span>&ensp;
									@endif
								</div>
							</li>
						@endforeach
					@else
						<p class="px-5 pb-4">No data to show.</p>
					@endif
				</ul>
			</div>
		</div>
		{{-- Right --}}
		<div class="col-md-3">
{{-- 			<p>
				<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
					Link with href
				</a>
			</p>
			<div class="collapse" id="collapseExample">
				<div class="card card-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
				</div>
			</div> --}}

			<a href="/job/post" class="btn -bleached btn-block text-uppercase fw-bold">
				<i class="far fa-sticky-note"></i>&ensp;
				Post a job
			</a>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	function jobPostRedirect(code){
		window.location="/job/post/" + code;
	}
</script>
@endsection