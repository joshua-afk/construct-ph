@extends('layouts.guest_app')
@php $page = 'contact-us' @endphp

@section('content')
<div class="form-container my-5">
	<div class="row">
		<div class="col-md-7">
			<h3>Contact Us</h3>
			<div class="form__header-line"></div>
			<form action="/contact-us" method="post">
				@csrf
				<div class="form-group">
					<input type="text" name="full_name" class="form-control" placeholder="Full Name">
				</div>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="E-Mail">
				</div>
				<div class="form-group">
					<input type="number" name="contact_number" class="form-control" placeholder="Contact Number">
				</div>
				<div class="form-group">
					<textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
				</div>
				<button class="btn -lime-outline btn-block">Send Email</button>
			</form>
		</div>
		<div class="col-md-5">
			
		</div>
	</div>
</div>
@endsection