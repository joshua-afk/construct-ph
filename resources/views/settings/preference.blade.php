@extends('layouts.app')

@section('content')
<div class="container py-5">
	<div class="row">
		{{-- Sidebar --}}
		<div class="col-3">
			@include('settings.sidebar')
		</div>
		{{-- / Sidebar --}}
		{{-- Main Contents --}}
		<div class="col-9">
			<div class="panel mb-4">
				<div class="panel__header">
					<h2 class="panel__title">Preferences</h2>
					<div class="panel__header-line"></div>
				</div>

				<div class="panel__body">
					<form action="/settings/preferences" method="post">
						<div class="w-75">
							@csrf
							@if ($user->preference !== null)
								@method('put')
							@endif

							<div class="form-group">
								<label class="fw-bold">Summary</label>
								<textarea name="summary" id="summary" class="form-control" rows="5">{{ ($user->preference !== null) ? $user->preference->summary : null }}</textarea>
								@error('summary') @alert() {{ $message }} @endalert @enderror
								<div class="text-right pt-1" id="summaryCounter"><span>355</span></div>
							</div>

							<div class="form-group">
								<label class="fw-bold">Relocation</label>
								<div class="icheck-material-lightgreen">
									<input type="checkbox" id="relocate" name="relocate" value="1" {{ $user->preference !== null && $user->preference->relocation === 1 ? 'checked' : null }}>
									<label class="fw-bold" for="relocate">I am willing to relocate</label>
								</div>
							</div>

							<div class="form-group">
								<label class="fw-bold">Desired Professional Services</label>

								<div class="icheck-material-lightgreen">
									<input type="checkbox" id="full_time" name="full_time" value="1" {{ $user->preference !== null && $user->preference->full_time === 1 ? 'checked' : null }}>
									<label class="fw-bold" for="full_time">Full-time</label>
								</div>

								<div class="icheck-material-lightgreen">
									<input type="checkbox" id="part_time" name="part_time" value="1" {{ $user->preference !== null && $user->preference->part_time === 1 ? 'checked' : null }}>
									<label class="fw-bold" for="part_time">Part-time</label>
								</div>

								<div class="icheck-material-lightgreen">
									<input type="checkbox" id="temporary" name="temporary" value="1" {{ $user->preference !== null && $user->preference->temporary === 1 ? 'checked' : null }}>
									<label class="fw-bold" for="temporary">Temporary</label>
								</div>

								<div class="icheck-material-lightgreen">
									<input type="checkbox" id="contract" name="contract" value="1" {{ $user->preference !== null && $user->preference->contract === 1 ? 'checked' : null }}>
									<label class="fw-bold" for="contract">Contract</label>
								</div>

								<div class="icheck-material-lightgreen">
									<input type="checkbox" id="internship" name="internship" value="1" {{ $user->preference !== null && $user->preference->internship === 1 ? 'checked' : null }}>
									<label class="fw-bold" for="internship">Internship</label>
								</div>

								<div class="icheck-material-lightgreen">
									<input type="checkbox" id="commission" name="commission" value="1" {{ $user->preference !== null && $user->preference->commission === 1 ? 'checked' : null }}>
									<label class="fw-bold" for="commission">Commission</label>
								</div>

								<div class="icheck-material-lightgreen">
									<input type="checkbox" id="new_grad" name="new_grad" value="1" {{ $user->preference !== null && $user->preference->new_grad === 1 ? 'checked' : null }}>
									<label class="fw-bold" for="new_grad">New-Grad</label>
								</div>
							</div>

							<div class="form-group">
								<label class="fw-bold">Who can see your resume?</label>
								@if ($user->preference !== null)
									<div class="icheck-material-lightgreen">
										<input type="radio" id="public" name="privacy" value="public" {{ $user->preference !== null && $user->preference->privacy === 'public' ? 'checked' : null }}>
										<label for="public">Public</label>
									</div>
									<div class="icheck-material-lightgreen">
										<input type="radio" id="private" name="privacy" value="private" {{ $user->preference !== null && $user->preference->privacy === 'private' ? 'checked' : null }}>
										<label for="private">Private</label>
									</div>
								@else
									<div class="icheck-material-lightgreen">
										<input type="radio" id="public" name="privacy" value="public" checked="checked">
										<label for="public">Public</label>
									</div>
									<div class="icheck-material-lightgreen">
										<input type="radio" id="private" name="privacy" value="private">
										<label for="private">Private</label>
									</div>
								@endif
							</div>

							<div class="mt-4">
								<button class="btn -submit mr-1">Submit</button>
								<a class="btn -back" href="/settings">Go back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
	CKEDITOR.replace('summary');
</script>
@endpush