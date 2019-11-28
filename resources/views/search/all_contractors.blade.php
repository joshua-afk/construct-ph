@extends('layouts.guest_app')
@php $page = 'all_contractors' @endphp

@section('content')
<search-all-contractors
	:company="{{ json_encode($company) }}"
	:companies_list="{{ json_encode($companies_list) }}"
	:classifications="{{ json_encode($classifications) }}"
></search-all-contractors>
@endsection