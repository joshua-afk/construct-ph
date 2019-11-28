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

	@include('partials.styles')
	@yield('styles')
	@stack('styles')
</head>
<body>
	<div id="app">
		@include('layouts.navbar-dark')
		<div class="main-container">
			@yield('content')
		</div>

		@yield('modal')
		@stack('modal')

		@include('layouts.footer')
	</div>	
	
	@include('partials.scripts')
	@yield('scripts')
	@stack('scripts')
</body>
@yield('social-api')
</html>