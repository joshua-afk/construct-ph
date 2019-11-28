@extends('layouts.app')

@section('content')
<div class="container py-5">
	<div class="row">
		<div class="col-3">
			@include('settings.sidebar')
		</div>
		<div class="col-9">
			<div class="panel mb-4">
				<div class="panel__header">
					<h2 class="panel__title">
						Trainings
						<button class="btn -lime float-right" type="button" data-toggle="modal" data-target="#trainingModal">
							<i class="fas fa-plus"></i>&ensp;Add
						</button>
					</h2>
					<div class="panel__header-line"></div>
				</div>

				<div class="panel__body">
					@forelse($user->trainings as $training)
					<div class="clean-container">
						<h5 class="clean-container-title"><i class="fas fa-tools"></i> {{ $training->title }}</h5>
						<p class="clean-container-sub-title">{{ $training->company }}</p>

						<p class="clean-container-text">{{ $training->cert_number }}</p>

						<p class="clean-container-year">{{ $training->started_at->format('Y M') }} - {{ $training->ended_at->format('Y M') }}</p>
					</div>
					@empty
					<div class="clean-container">
						<p>No data to show</p>
					</div>
					@endforelse
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('modal')
<!-- Modal -->
<div class="modal fade" id="trainingModal" tabindex="-1" role="dialog" aria-labelledby="trainingModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="trainingModalLabel">Add training</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="/settings/trainings" method="post">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label class="fw-bold">Title</label>
						<input
							class="form-control @error('title') is-invalid @enderror"
							type="text"
							name="title"
							value="{{ old('title') }}">
						@error('title') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-group">
						<label class="fw-bold">Company</label>
						<input
							class="form-control @error('company') is-invalid @enderror"
							type="text"
							name="company"
							value="{{ old('company') }}">
						@error('company') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-row mb-3">
						<div class="col">
							<label class="fw-bold">Time period</label>
							<input class="form-control @error('started_at') is-invalid @enderror" type="date" name="started_at" value="{{ old('started_at') }}">
							@error('started_at') @alert() {{ $message }} @endalert @enderror
						</div>
						<div class="col">
							<label class="fw-bold">&ensp;</label>
							<input class="form-control @error('ended_at') is-invalid @enderror" type="date" name="ended_at" value="{{ old('ended_at') }}">
							@error('ended_at') @alert() {{ $message }} @endalert @enderror
						</div>
					</div>

					<div class="form-group">
						<label class="fw-bold">Certificate Number</label>
						<input
							class="form-control @error('cert_number') is-invalid @enderror"
							type="text"
							name="cert_number"
							value="{{ old('cert_number') }}">
						@error('cert_number') @alert() {{ $message }} @endalert @enderror
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn -back" type="button" data-dismiss="modal">Close</button>
					<button class="btn -submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endpush

@if (!$errors->isEmpty())
@push('scripts')
	<script>
		$('.modal').modal('show');
	</script>
@endpush
@endif