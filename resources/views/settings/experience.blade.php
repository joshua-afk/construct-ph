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
						Experiences
						<button class="btn -lime float-right" type="button" data-toggle="modal" data-target="#experienceModal">
							<i class="fas fa-plus"></i>&ensp;Add
						</button>
					</h2>
					<div class="panel__header-line"></div>
				</div>

				<div class="panel__body">
					@forelse($user->experiences as $experience)
					<div class="clean-container">
						<h5 class="clean-container-title">
							<i class="fas fa-briefcase"></i> {{ $experience->job_title }} | {{ $experience->company }}
						</h5>
						<div class="ckeditor-container">
							<span class="d-block -bold">Responsibilities:</span>
							{!! $experience->responsibilities !!}
						</div>
						<div class="ckeditor-container">
							<span class="d-block -bold">Accomplishments:</span>
							@if ($experience->accomplishments !== null)
								{!! $experience->accomplishments !!}
							@else
								<p>No data to show</p>
							@endif
						</div>
						<div class="ckeditor-container">
							<span class="d-block -bold">Skills:</span>
							@if ($experience->skills !== null)
								{!! $experience->skills !!}
							@else
								<p>No data to show</p>
							@endif
						</div>
						<p class="clean-container-year">{{ $experience->started_at->format('Y M').' - '.$experience->ended_at->format('Y M') }}</p>
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
<div class="modal fade" id="experienceModal" tabindex="-1" role="dialog" aria-labelledby="experienceModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title fw-bold" id="experienceModalLabel">Add Experience</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="/settings/experiences" method="post">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label class="fw-bold">Job title</label>
						<input
							class="form-control @error('job_title') is-invalid @enderror"
							type="text"
							name="job_title"
							value="{{ old('job_title') }}">
						@error('job_title') @alert() {{ $message }} @endalert @enderror
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

					<div class="form-row form-group">
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
						<label class="fw-bold">Responsibilities&ensp;(Optional)</label>	
						<textarea class="form-control" name="responsibilities" id="responsibilities">{{ old('responsibilities') }}</textarea>
						@error('responsibilities') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-group">
						<label class="fw-bold">Accomplishments&ensp;(Optional)</label>
						<textarea class="form-control" name="accomplishments" id="accomplishments">{{ old('accomplishments') }}</textarea>
						@error('accomplishments') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-group">
						<label class="fw-bold">Skills used&ensp;(Optional)</label>
						<textarea class="form-control" name="skills" id="skills">{{ old('skills') }}</textarea>
						@error('skills') @alert() {{ $message }} @endalert @enderror
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

@push('scripts')
<script>
	CKEDITOR.replace('responsibilities');
	CKEDITOR.replace('accomplishments');
	CKEDITOR.replace('skills');

	@if (!$errors->isEmpty())
	$('.modal').modal('show');
	@endif
</script>
@endpush