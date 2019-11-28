@extends('layouts.app')

@section('styles')
<style>
	.fa-check-circle{
		color: #A7CB00;
	}

	.rating{
		height: 2rem;
		display: table;
	}

	/****** Style Star Rating Widget *****/
	.rating > input { display: none; } 
	.rating > label:before { 
		margin: 5px;
		font-size: 2rem;
		font-family: "Font Awesome 5 Free";
		display: inline-block;
		content: "\f005";
	}

	.rating > .half:before { 
		content: "\f089";
		position: absolute;
	}

	.rating > label { 
	 	color: #ddd; 
	 	float: right; 
	}

	/***** CSS Magic to Highlight Stars on Hover *****/

	.rating > input:checked ~ label, /* show gold star when clicked */
	.rating:not(:checked) > label:hover, /* hover current star */
	.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

	.rating > input:checked + label:hover, /* hover current star when changing rating */
	.rating > input:checked ~ label:hover,
	.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
	.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 

	.review-star{
		color: #FFC000;
		font-size: 18px;
	}
</style>
@endsection

{{-- Accurately filter the entity_id to company and user --}}
@if (session('type') === 4)
	@if ($job->entity_id === 2 && $job->entity_id === session('user_id'))
		@include('jobs.show.owner')
	@else
		@include('jobs.show.applicant')
	@endif
@else
	@if ($job->entity_id === session('user_id'))
		@include('jobs.show.owner')
	@else
		@include('jobs.show.applicant')
	@endif
@endif

@push('scripts')
<script>
	$(document).ready(function() {
		$(".select2-companies").select2({
			placeholder: "Select a company..."
		});

		$(".select2-modal-companies").select2({
			placeholder: "Select a company...",
		});
	});

	CKEDITOR.replace('proposal');
	CKEDITOR.replace('proposal_update');
	CKEDITOR.replace('description');
</script>
@endpush