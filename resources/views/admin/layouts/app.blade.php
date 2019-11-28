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

	@include('admin.partials.styles')
	@yield('styles')
</head>

<body id="page-top">
	<div id="wrapper">
		@include('admin.layouts.sidebar')

		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				{{-- Navbar --}}
				@include('admin.layouts.navbar')

				{{-- Content --}}
				<div class="container-fluid">
					@yield('content')
				</div>
			</div>
			<!-- End of Main Content -->

			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Your Website 2019</span>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	{{-- Logout Modal --}}
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="/logout" onclick="event.preventDefault();logout()">Logout</a>
					<form id="logout-form" action="/logout" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</div>
		</div>
	</div>

	@yield('modals')

	@include('admin.partials.scripts')
	<script>
		function logout(event){
			document.getElementById('logout-form').submit();
		}
	</script>
	@yield('scripts')
</body>
</html>
