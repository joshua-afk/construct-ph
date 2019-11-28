@extends('layouts.guest_app')

@section('styles')
<style>
	p, p > a{
		margin-bottom: 1rem;
		font-size: 1.2rem;
		line-height: 2rem;
	}
</style>
@endsection

@section('content')
<section style="height: 400px;">
	<div class="banner" style="height: 400px;">
		<div class="banner__carousel-container">
			<img class="d-block img-responsive w-100" style="height: 400px" src="storage/images/banner/home-banner.jpg" alt="First slide">
		</div>
	</div>
	<div class="banner__text-container" style="top: 190px">
		<div class="container">
			<h1 class="banner__title">About us</h1>
			<div class="banner-text__line"></div>
		</div>
	</div>
</div>
</section>

<section class="my-5">
	<div class="container">
		<div class="mb-5">
			<h1 class="text-center mb-3 fw-bold">WHO WE ARE</h1>
			<p class="text-muted">
				Construct.PH aims to be the premier online directory for the Philippine Construction Industry. We are committed to use technology
				to bridge the divide between stakeholders in this industry. This enables projects to have qualified personnel, have the right
				materials and equipment and most qualified contractors based on the clients need so they can complete their projects inside the
				given time frame, within the allocated budget and with excellent quality.
			</p>
			<p class="text-muted">Our office is at Greenhills Mansion, Annapolis St., Greenhills, San Juan, Metro Manila.</p>
			<p class="text-muted">You may reach us at <a href="tel:(+632) 8-3400-800">(+632) 8-3400-800</a> if you need further inquiries.</p>
			<p class="text-muted">You may also get in touch with us via email at <a href="mailto:inquiries@construct.ph">inquiries@construct.ph</a></p>
		</div>

		<hr class="cstm-hr">

		<div class="my-5" style="width: 100%; height: 500px;">
			{!! Mapper::render() !!}
		</div>
	</div>
</section>
@endsection