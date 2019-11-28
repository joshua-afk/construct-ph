@extends('layouts.app')

@section('content')
<div class="container pt-5 mb-5">
	<div class="panel mx-auto w-75">
		{{-- <form action=""> --}}
			{{-- @csrf --}}
			<div class="panel__header">
				<h2 class="panel__title">Create a Job Post</h2>
				<div class="panel__header-line"></div>
			</div>

			<div class="panel__body w-75">

				<div class="form-group">
					<button class="btn -submit mr-1" type="submit">Submit</button>
					<a class="btn -back" href="">Go back</a>
				</div>
			</div>
		{{-- </form> --}}
	</div>
</div>

{{-- Profile --}}
<div class="d-flex">
	<div>
		<div class="container--img-border overflow-hidden rounded-circle" style="height: 50px; width: 50px">
			<img src="/storage/images/profile-images/{{ $profile_image ?? 'default.png' }}" class="img--responsive" alt="{{ $username }}">
		</div>
	</div>
	<div class="ml-2">
		<div class="d-flex align-items-center">
			<p>
				<a href="/profile/{{ $username }}">{{ $name }}</a>
				<br>
				<small class="text-muted">
					{{ \Carbon\Carbon::parse($created_at)->diffForHumans() }} at {{ \Carbon\Carbon::parse($created_at)->format('g:i A') }}
				</small>
				<br>
				<span>Company: </span> {{ $company ?? 'N/A' }}
			</p>
		</div>
		<p class="mt-2">Text Here</p>
	</div>
</div>
{{-- / Profile --}}
@endsection