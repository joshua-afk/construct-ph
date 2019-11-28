@extends('layouts.app')

@push('styles')
<style>
	.general-card-link{
		border-top: 1px solid #e5e5e5;
	}
	.general-card-link:hover{
		background-color: #f5f5f5;
	}
</style>
@endpush

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
			<div class="row pb-4">
				{{-- Preference --}}
				<div class="col-6">
					<div class="panel">
						<div class="px-4 pt-4">
							<h2>Preference</h2>	
						</div>
						<div class="px-4 pb-3">
							<p class="text-muted">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
							</p>
						</div>
						<div class="px-4 py-3 general-card-link">
							<a href="/settings/preferences">Go to preference</a>
						</div>
					</div>
				</div>
				{{-- / Preference --}}
				{{-- Education --}}
				<div class="col-6">
					<div class="panel">
						<div class="px-4 pt-4">
							<h2>Education</h2>	
						</div>
						<div class="px-4 pb-3">
							<p class="text-muted">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
							</p>
						</div>
						<div class="px-4 py-3 general-card-link">
							<a href="/settings/educations">Go to education</a>
						</div>
					</div>
				</div>
				{{-- Education --}}
			</div>
			<div class="row pb-4">
				{{-- Experiences --}}
				<div class="col-6">
					<div class="panel">
						<div class="px-4 pt-4">
							<h2>Experiences</h2>	
						</div>
						<div class="px-4 pb-3">
							<p class="text-muted">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
							</p>
						</div>
						<div class="px-4 py-3 general-card-link">
							<a href="/settings/experiences">Go to Experiences</a>
						</div>
					</div>
				</div>
				{{-- / Experiences --}}
				{{-- Trainings --}}
				<div class="col-6">
					<div class="panel">
						<div class="px-4 pt-4">
							<h2>Trainings</h2>	
						</div>
						<div class="px-4 pb-3">
							<p class="text-muted">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
							</p>
						</div>
						<div class="px-4 py-3 general-card-link">
							<a href="/settings/trainings">Go to trainings</a>
						</div>
					</div>
				</div>
				{{-- Trainings --}}
			</div>
			<div class="row">
				{{-- Licensures & Certificates --}}
				<div class="col-6">
					<div class="panel">
						<div class="px-4 pt-4">
							<h2>Licensures & Certificates</h2>	
						</div>
						<div class="px-4 pb-3">
							<p class="text-muted">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
							</p>
						</div>
						<div class="px-4 py-3 general-card-link">
							<a href="/settings/licensures">Go to licensures & certificates</a>
						</div>
					</div>
				</div>
				{{-- / Licensures & Certificates --}}
				{{-- Affiliations --}}
				<div class="col-6">
					<div class="panel">
						<div class="px-4 pt-4">
							<h2>Affiliations</h2>	
						</div>
						<div class="px-4 pb-3">
							<p class="text-muted">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
							</p>
						</div>
						<div class="px-4 py-3 general-card-link">
							<a href="/settings/affiliations">Go to affiliations</a>
						</div>
					</div>
				</div>
				{{-- Affiliations --}}
			</div>
		</div>
	</div>
</div>
@endsection
