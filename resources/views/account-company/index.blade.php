@extends('layouts.app')

@section('styles')
<style>
	.card{
		border: none;
		background-color: transparent;
	}

	.btn.btn-light.btn-lg{
		font-size: 1rem;
		padding: 7px 2rem;
	}
</style>
@endsection

@section('content')
<section class="user-companies-section content-section">
	<div class="container">
		<div class="user-companies-container">
			<div class="row">
				<div class="col-md-9 ">
					@foreach ($user_companies as $company)
					<div class="content-container p-0 mb-4" style="border-radius: 15px;">
						{{-- Card --}}
						<div class="card p-4">
							<div class="row no-gutters">
								<div class="col-auto card__img-wrapper -pointer" onclick="showCompany('{{$company->code}}')">
									<img src="{{ ($company->image != null) ? asset('storage/images/companies/'.$company->image) : asset('storage/images/noimage.png') }}" class="img-fluid" alt="{{ $company->image }}">
								</div>
								<div class="col">
									<div class="card-block px-2">
										<div class="row">
											<div class="col-md-7" style="display: flex; justify-content: center; flex-direction: column;">
												<h5 class="mb-0">{{ $company->company_name }}</h5>
											</div>
											<div class="col-md-5 btn-group text-right" role="group">
												<a href="#" class="btn -lime btn-sm disabled" style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; font-size: 15px">
													{{-- <i class="fas fa-layer-group"></i>&ensp; --}}
												Manage</a>
												<a href="/account/companies/{{ $company->code }}/edit" class="btn -lime-outline btn-sm disabled" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; font-size: 15px" >
													{{-- <i class="fas fa-wrench"></i>&ensp; --}}
												Edit</a>
											</div>
										</div>
										<p class="small-like fw-bold mt-2 mb-1">{{ $company->authorized_managing_officer }} - {{ $company->pcab_license }}</p>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima obcaecati quos ducimus quam in cum praesentium officiis consequuntur vero blanditiis sint eius, repudiandae fugiat voluptatem dolorem asperiores consequatur, alias officia.</p>
									</div>
								</div>
							</div>
						</div>
						{{-- / Card --}}
					</div>
					@endforeach
				</div>
				
				<div class="col-md-3">
					<a class="btn -bleached btn-block text-uppercase fw-bold" href="/companies/create"><i class="fas fa-tools"></i>&ensp;Create Company</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('scripts')
<script>
	function showCompany(code){
		window.location.href = "/account/companies/" + code;
	}
</script>
@endsection