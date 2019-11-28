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
					<h2 class="panel__title">Password</h2>
					<div class="panel__header-line"></div>
				</div>

				@if (session('success'))
					<div class="px-4">
						@include('components.alert', [
							'class' => 'alert-success mb-0',
							'slot'  => '<strong>Success!</strong> Password successfully changed.'
						])
					</div>
				@endif

				<div class="panel__body">
					<form action="/settings/password" method="post">
						<div class="w-75">
							@csrf
							@method('put')

							<div class="form-group">
								<label for="current_password" class="mb-2 fw-bold">Current Password</label>
								<div class="input-group">
									<input type="password" class="form-control @error('current_password') is-invalid @enderror @if(session('failure')) is-invalid @endif" id="currentPassword" name="current_password" placeholder="Enter your current password">
									<div class="input-group-append" id="showCurrentPassword" onclick="showCurrentPassword()">
										<span class="input-group-text"><i class="fas fa-eye"></i></span>
									</div>
									<div class="input-group-append" id="hideCurrentPassword" onclick="hideCurrentPassword()">
										<span class="input-group-text"><i class="fas fa-eye-slash"></i></span>
									</div>
								</div>
								@if(session('failure')) @alert() {{ session('failure') }} @endalert @enderror
								@error('current_password') @alert() {{ $message }} @endalert @enderror
							</div>

							<label for="new_password" class="mb-2 fw-bold">New Password</label>
							<div class="form-group">
								<div class="input-group">
									<input type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPassword" name="new_password" placeholder="Enter new password">
									<div class="input-group-append" id="showNewPassword" onclick="showNewPassword()">
										<span class="input-group-text"><i class="fas fa-eye"></i></span>
									</div>
									<div class="input-group-append" id="hideNewPassword" onclick="hideNewPassword()">
										<span class="input-group-text"><i class="fas fa-eye-slash"></i></span>
									</div>
								</div>
								@error('new_password') @alert() {{ $message }} @endalert @enderror
							</div>

							<div class="form-group">
								<input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="newPasswordConfirmation" name="new_password_confirmation" placeholder="Confirm new password">
								@error('new_password_confirmation') @alert() {{ $message }} @endalert @enderror
							</div>

							<div class="form-group mt-4">
								<button class="btn -submit" type="submit">Save</button>
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
	$('document').ready( function() {
		$('#hideCurrentPassword').hide();
		$('#hideNewPassword').hide();
	});

	function showCurrentPassword(){
		$('#showCurrentPassword').hide();
		$('#hideCurrentPassword').show();
		$('#currentPassword').attr('type', 'text');
	}
	function hideCurrentPassword(){
		$('#showCurrentPassword').show();
		$('#hideCurrentPassword').hide();
		$('#currentPassword').attr('type', 'password');
	}
	function showNewPassword(){
		$('#showNewPassword').hide();
		$('#hideNewPassword').show();
		$('#newPassword').attr('type', 'text');
	}
	function hideNewPassword(){
		$('#showNewPassword').show();
		$('#hideNewPassword').hide();
		$('#newPassword').attr('type', 'password');
	}
</script>
@endpush