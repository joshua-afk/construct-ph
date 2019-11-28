@extends('layouts.app')

@section('styles')
<style>
	.fa-chevron-circle-down{
		color: #a7cb00;
	}

	.accordion-header{
		cursor: pointer;
		margin-bottom: 0;
		font-size: 1.18rem;
	}
</style>
@endsection

@section('content')
<manage-account
	:account="{{ json_encode($account) }}"
	:regions="{{ json_encode($regions) }}"
	:cities="{{ json_encode($cities) }}"
></manage-account>
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
</script>
@endsection