<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

	<title>Construct PH</title>

	{{-- @include('partials.styles') --}}
	<link rel="stylesheet" href="{{ asset('/vendor/startbootstrap-sb-admin-2-gh-pages/css/sb-admin-2.min.css') }}">
	@yield('styles')
</head>
<body class="a-body">
	<div id="app">
		@yield('navbar')
		
		<section class="a-section">
			@include('admin.layouts.sidebar')
			
			<main class="a-main">
				@yield('content')
			</main>
		</section>

		@yield('modal')
	</div>	
	
	{{-- @include('partials.scripts') --}}
	<script src="{{ asset('vendor/startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js') }}"></script>
	@yield('scripts')
</body>
</html>