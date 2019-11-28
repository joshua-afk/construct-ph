@extends('layouts.app')

@section('content')
<div class="container py-5">
	<div class="panel w-50 mx-auto">
		<div class="panel__header">
			<h2 class="panel__title">Account Role</h2>
			<div class="panel__header-line"></div>
		</div>
		<div class="panel__body">
			<form method="post" action="/user-role" class="w-75">
				@csrf
				<input type="hidden" name="user_id" value="{{ $user->id }}">
				<div class="form-group">
					<select name="role" class="form-control select2" required>
						<option value=""></option>
						<option value="client">I'm a Client</option>
						<option value="professional">I'm a Professional</option>
						<option value="company">I'll Create a Company</option>
					</select>
				</div>

				<div class="form-group">
					<button class="btn -lime">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		$(".select2").select2({
			placeholder: "Who are you?",
			allowClear: true
		});
	});
</script>
@endsection