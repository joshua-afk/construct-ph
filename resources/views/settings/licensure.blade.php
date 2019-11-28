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
						Licensures
						<button class="btn -lime float-right" type="button" data-toggle="modal" data-target="#licensureModal">
							<i class="fas fa-plus"></i>&ensp;Add
						</button>
					</h2>
					<div class="panel__header-line"></div>
				</div>

				<div class="panel__body">
					@forelse($user->licensures as $licensure)
					<div  class="clean-container">
						<h5 class="clean-container-title"><i class="far fa-id-badge"></i> {{ $licensure->name }}</h5>
						<p class="clean-container-sub-title">{{ $licensure->type }}</p>
						<p class="clean-container-text">{{ $licensure->number }}</p>
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
<div class="modal fade" id="licensureModal" tabindex="-1" role="dialog" aria-labelledby="licensureModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="licensureModalLabel">Add licensure</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="/settings/licensures" method="post">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label class="fw-bold">Type</label>
						<select class="form-control" name="type">
							<option value="licensure">Licensure</option>
							<option value="certificate">Certificate</option>
						</select>
						@error('type') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-group">
						<label class="fw-bold">Name</label>
						<input
							class="form-control @error('name') is-invalid @enderror"
							type="text"
							name="name"
							value="{{ old('name') }}">
						@error('name') @alert() {{ $message }} @endalert @enderror
					</div>

					<div class="form-group">
						<label class="fw-bold">Number</label>
						<input
							class="form-control @error('number') is-invalid @enderror"
							type="text"
							name="number"
							value="{{ old('number') }}">
						@error('number') @alert() {{ $message }} @endalert @enderror
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
	$(document).ready(function() {
		$(".select2-type").select2({
			allowClear: true
		});
	});
	@if (!$errors->isEmpty())
	$('.modal').modal('show');
	@endif
</script>
@endpush