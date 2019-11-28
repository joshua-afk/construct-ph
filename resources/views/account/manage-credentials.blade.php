@extends('layouts.app')

@section('styles')
<style>
	.fa-chevron-circle-down{
		color: #a7cb00;
	}
</style>
@endsection

@section('content')
<manage-credentials
	:account			  = "{{ json_encode($account) }}"
	:account_licensures	  = "{{ json_encode($account_licensures) }}"
	:account_affiliations = "{{ json_encode($account_affiliations) }}"
	:regions			  = "{{ json_encode($regions) }}"
	:cities				  = "{{ json_encode($cities) }}"
	:account_educations	  = "{{ json_encode($account_educations) }}"
	:account_preferences  = "{{ json_encode($account_preferences) }}"
	:account_experiences  = "{{ json_encode($account_experiences) }}"
	:resume_trainings	  = "{{ json_encode($resume_trainings) }}"
></manage-credentials>
@endsection

@section('scripts')
<script>
	$(".select2-city").select2({
		placeholder: "City / Municipality",
		width: '100%',
	});

	$(".select2-region").select2({
		placeholder: "Region",
		width: '100%',
	});

	setInterval(
		function(){
			summary = document.getElementById('summary');
			text = summary.value;

			document.getElementById('summaryCounter').innerHTML = 355 - text.length;

			if (text.length <= 355) {
				document.getElementById('profileSubmit').disabled = false;
			} else if (text.length >= 0) {
				document.getElementById('profileSubmit').disabled = true;
			}
		},
		100);
</script>
@endsection