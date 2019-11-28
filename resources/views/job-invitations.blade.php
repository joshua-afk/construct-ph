@extends('layouts.app')

@push('styles')
	<style>
		.p-4.row:hover{
			background-color: #f1f1f1;
		}
	</style>
@endpush

@section('content')
<div class="container pt-5 mb-5">
	<div class="panel mx-auto">
		<div class="panel__header">
			<h2 class="panel__title">Job invitations</h2>
			<div class="panel__header-line"></div>
		</div>

		<div class="panel__body p-0 overflow-hidden">
			@foreach ($job_invitations as $job_invitation)
			@if($job_invitation->job->isFromClient())
			<div class="row p-4">
				<div class="col-md-9 d-flex">
					<div>
						<div class="container--img-border overflow-hidden rounded-circle" style="height: 80px; width: 80px">
							<img src="/storage/images/profile-images/{{ $job_invitation->job->client->image ?? 'default.png' }}" class="img--responsive" alt="no-image">
						</div>
					</div>
					<div class="ml-4">
						<div class="d-flex align-items-center">
							<p>
								<a href="/profile/{{ $job_invitation->job->client->username }}">{{ $job_invitation->job->client->first_name.' '.$job_invitation->job->client->last_name }}</a><small class="text-muted"> &#8231; {{ $job_invitation->job->created_at->diffForHumans().' at '.$job_invitation->job->created_at->format('g:i A') }}</small>
								<br>
								<span>Company: N/A</span>
							</p>
						</div>
						@if (strlen($job_invitation->job->description) > 80)
							<p class="mt-2">{!! substr($job_invitation->job->description, 0, 80) !!} <a href="/jobs/{{ $job_invitation->job->code }}">see more...</a></p>
						@else
							<p class="mt-2">{!! $job_invitation->job->description !!}</p>
						@endif
					</div>
				</div>
				<div class="col-md-3 my-auto">
					<button class="btn -lime"><i class="fas fa-check"></i> Accept</button>
					<button class="btn -red"><i class="fas fa-times"></i> Decline</button>
				</div>
			</div>
			@elseif ($job_invitation->job->isFromProfessional())
			<div class="row p-4">
				<div class="col-md-9 d-flex">
					<div>
						<div class="container--img-border overflow-hidden rounded-circle" style="height: 80px; width: 80px">
							<img src="/storage/images/profile-images/{{ $job_invitation->job->professional->image ?? 'default.png' }}" class="img--responsive" alt="no-image">
						</div>
					</div>
					<div class="ml-4">
						<div class="d-flex align-items-center">
							<p>
								<a href="/profile/{{ $job_invitation->job->professional->username }}">{{ $job_invitation->job->professional->first_name.' '.$job_invitation->job->professional->last_name }}</a><small class="text-muted"> &#8231; {{ $job_invitation->job->created_at->diffForHumans().' at '.$job_invitation->job->created_at->format('g:i A') }}</small>
								<br>
								<span>Company: N/A</span>
							</p>
						</div>
						@if (strlen($job_invitation->job->description) > 80)
							<p class="mt-2">{!! substr($job_invitation->job->description, 0, 80) !!} <a href="/jobs/{{ $job_invitation->job->code }}">see more...</a></p>
						@else
							<p class="mt-2">{!! $job_invitation->job->description !!}</p>
						@endif
					</div>
				</div>
				<div class="col-md-3 my-auto">
					<button class="btn -lime"><i class="fas fa-check"></i> Accept</button>
					<button class="btn -red"><i class="fas fa-times"></i> Decline</button>
				</div>
			</div>
			@elseif($job_invitation->job->isFromCompany())
			<div class="row p-4">
				<div class="col-md-9 d-flex">
					<div>
						<div class="container--img-border overflow-hidden rounded-circle" style="height: 80px; width: 80px">
							<img src="/storage/images/profile-images/{{ $job_invitation->job->company->image ?? 'default.png' }}" class="img--responsive" alt="no-image">
						</div>
					</div>
					<div class="ml-4">
						<div class="d-flex align-items-center">
							<p>
								<a href="/profile/{{ $job_invitation->job->company->username }}">{{ $job_invitation->job->company->user->first_name.' '.$job_invitation->job->company->user->last_name }}</a><small class="text-muted"> &#8231; {{ $job_invitation->job->created_at->diffForHumans().' at '.$job_invitation->job->created_at->format('g:i A') }}</small>
								<br>
								<span>Company: </span><a href="/companies/{{ $job_invitation->job->company->code }}">{{ $job_invitation->job->company->company_name }}</a>
							</p>
						</div>
						@if (strlen($job_invitation->job->description) > 80)
							<p class="mt-2">{!! substr($job_invitation->job->description, 0, 80) !!} <a href="/jobs/{{ $job_invitation->job->code }}">see more...</a></p>
						@else
							<p class="mt-2">{!! $job_invitation->job->description !!}</p>
						@endif
					</div>
				</div>
				<div class="col-md-3 my-auto">
					<button class="btn -lime"><i class="fas fa-check"></i> Accept</button>
					<button class="btn -red"><i class="fas fa-times"></i> Decline</button>
				</div>
			</div>
			@endif
			@endforeach
		</div>
	</div>
</div>
@endsection