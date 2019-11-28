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
						Educations
						<button class="btn -lime float-right" type="button" data-toggle="modal" data-target="#educationModal">
							<i class="fas fa-plus"></i>&ensp;Add
						</button>
					</h2>
					<div class="panel__header-line"></div>
				</div>

				<div class="panel__body">
					@forelse($user->educations as $education)
					<div class="clean-container">
						<div class="clean-container-header">
							<div class="clean-container-header__icon"><i class="fas fa-graduation-cap"></i></div>
							<h5 class="clean-container-title">{{ $education->degree }}</h5>
							<h5 class="clean-container-title">{{ $education->field }}</h5>
						</div>
						<!-- <h5 class="clean-container-title"><i class="fas fa-graduation-cap"></i> {{ $education->degree }} | {{ $education->field }}</h5> -->
						<p class="clean-container-sub-title">{{ $education->school }}</p>
						<p class="clean-container-year">{{ $education->started_at->format('Y').' - '.$education->ended_at->format('Y') }}</p>
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
<div class="modal fade" id="educationModal" tabindex="-1" role="dialog" aria-labelledby="educationModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="educationModalLabel">Add education</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="/settings/educations" method="post">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label class="fw-bold">Degree</label>
						<input
							class="form-control @error('degree') is-invalid @enderror"
							type="text"
							name="degree"
							value="{{ old('degree') }}">
						@error('degree') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-group">
						<label class="fw-bold">Field of Study</label>
						<input
							class="form-control @error('field') is-invalid @enderror"
							type="text"
							name="field"
							value="{{ old('field') }}">
						@error('field') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-group">
						<label class="fw-bold">School</label>
						<input
							class="form-control @error('school') is-invalid @enderror"
							type="text"
							name="school"
							value="{{ old('school') }}">
						@error('school') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-row">
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

					{{-- <div class="form-row">
						<div class="col">
							@include('components.datepicker', [
								'label' => 'Time period',
								'name'  => 'started_at'
							])
						</div>
						<div class="col">
							@include('components.datepicker', [
								'name'  => 'ended_at'
							])
						</div>
					</div> --}}
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