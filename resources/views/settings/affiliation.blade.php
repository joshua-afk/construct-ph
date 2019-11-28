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
						Affiliations
						<button class="btn -lime float-right" type="button" data-toggle="modal" data-target="#affiliationModal">
							<i class="fas fa-plus"></i>&ensp;Add
						</button>
					</h2>
					<div class="panel__header-line"></div>
				</div>

				<div class="panel__body">
					@forelse($user->affiliations as $affiliation)
					<div  class="clean-container">
						<h5 class="clean-container-title"><i class="fas fa-users-cog"></i> {{ $affiliation->organization_name }}</h5>
						<p class="clean-container-sub-title">{{ ucfirst($affiliation->status) }}</p>

						<p class="clean-container-year">{{ $affiliation->started_at->format('Y') }} - {{ $affiliation->ended_at->format('Y') }}</p>
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
<div class="modal fade" id="affiliationModal" tabindex="-1" role="dialog" aria-labelledby="affiliationModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="affiliationModalLabel">Add affiliation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="/settings/affiliations" method="post">
				@csrf
				<div class="modal-body">
					
					<div class="form-group">
						<label class="fw-bold">Status</label>
						<select name="status" class="form-control">
							<option value="active">Active</option>
							<option value="inactive">Inactive</option>
						</select>
						@error('status') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-group">
						<label class="fw-bold">Organization Name</label>
						<input
							class="form-control @error('organization_name') is-invalid @enderror"
							type="text"
							name="organization_name"
							value="{{ old('organization_name') }}">
						@error('organization_name') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-group">
						<label class="fw-bold">Position</label>
						<input
							class="form-control @error('position') is-invalid @enderror"
							type="text"
							name="position"
							value="{{ old('position') }}">
						@error('position') @alert() {{ $message }} @endalert @enderror
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