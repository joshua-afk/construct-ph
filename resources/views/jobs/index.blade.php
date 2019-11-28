@extends('layouts.app')

@section('content')
<div class="container pt-5">
	<div class="row mb-5">
		{{-- Left --}}
		<div class="col-md-9">
			<div class="home-search-container">
				<p action="/job/search" method="post">
					@csrf

					<div class="input-group mb-3" style="z-index: 1">
						<input type="text" class="form-control" placeholder="Search...">
						<div class="input-group-append">
							<button class="btn -lime" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;" type="button"><i class="fas fa-search active" aria-hidden="true"></i></button>
						</div>
					</div>
				</p>
			</div>
			
			@if (!$jobs->isEmpty())
			<ul>
				@foreach ($jobs as $job)
				{{-- <li class="-pointer" onclick="jobPostRedirect('{{ $job->code }}')"> --}}
					<li>
						@if($job->isFromClient())
						@include('components.job-post-card', [
							'id'       	 => $job->id,
							'code'       => $job->code,
							'date' 	     => $job->created_at->diffForHumans().' at '.$job->created_at->format('g:i A'),
							'job_title'  => $job->title,
							'image' 	 => $job->client->image,
							'username'   => $job->client->username,
							'company'    => 'N/A',
							'salary_min' => $job->salary_min,
							'salary_max' => $job->salary_max,
							'name' 	 	 => $job->client->first_name.' '.$job->client->last_name,
							'content'    => $job->description,
							'classifications' => $job->job_classifications,
							'bookmarks'  => $user_job_bookmarks
							])
							@elseif ($job->isFromProfessional())
							@include('components.job-post-card', [
								'id'       	 => $job->id,
								'code'       => $job->code,
								'date' 	     => $job->created_at->diffForHumans().' at '.$job->created_at->format('g:i A'),
								'job_title'  => $job->title,
								'image' 	 => $job->professional->image,
								'username'   => $job->professional->username,
								'company'    => 'N/A',
								'salary_min' => $job->salary_min,
								'salary_max' => $job->salary_max,
								'name' 	 	 => $job->professional->first_name.' '.$job->professional->last_name,
								'content'    => $job->description,
								'classifications' => $job->job_classifications,
								'bookmarks'  => $user_job_bookmarks
								])
								@elseif($job->isFromCompany())
								@include('components.job-post-card', [
									'id'       	 => $job->id,
									'code'       => $job->code,
									'date' 	     => $job->created_at->diffForHumans().' at '.$job->created_at->format('g:i A'),
									'job_title'  => $job->title,
									'image' 	 => $job->company->image,
									'username'   => $job->company->username,
									'company'    => $job->company->company_name,
									'salary_min' => $job->salary_min,
									'salary_max' => $job->salary_max,
									'name' 		 => $job->company->user->first_name.' '.$job->company->user->last_name,
									'content'    => $job->description,
									'classifications' => $job->job_classifications,
									'bookmarks'  => $user_job_bookmarks
									])
									@endif
								</li>
								@endforeach
							</ul>
							@else
							<div class="panel pt-4">
								<p class="px-5 pb-4">No data to show.</p>
							</div>
							@endif
						</div>
						{{-- Right --}}
						<div class="col-md-3">
							<a href="/jobs/create" class="btn -bleached btn-block text-uppercase fw-bold">
								<i class="far fa-sticky-note"></i>&ensp;
								Post a job
							</a>
						</div>
					</div>
				</div>
				@endsection

				@section('scripts')
				<script>
	// function jobPostRedirect(code){
	// 	window.location="/jobs/" + code;
	// }
	function bookmark(code){
		document.getElementById('bookmark-form-' + code).submit();
	}

	function unbookmark(code){
		document.getElementById('unbookmark-form-' + code).submit();
	}
</script>
@endsection