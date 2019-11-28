@section('content')

<div class="container my-5">
	<div class="row mb-4">
		{{-- Job Information --}}
		<div class="col-md-9">
			<div class="company-blog__container">
				@if ($job->isFromCompany())
					<div class="blog-card">
						<div>
							<div>
								<span class="fw-500">Job</span> &#8231;
								<span class="text-muted">
									{{ $job->created_at->diffForHumans().' at '.$job->created_at->format('g:i A') }}
								</span>
							</div>
							<div class="my-2">
								<h2>{{ $job->title }}</h2>
							</div>
						</div>
						<div class="blog-card__profile">
							{{-- Left (Profile) --}}
							<div>
								<div class="container--img-border overflow-hidden rounded-circle" style="height: 70px; width: 70px">
									<img src="/storage/images/profile-images/{{ $job->company->logo ?? 'default.png' }}" class="img--responsive" alt="{{ $job->company->logo }}">
								</div>
							</div>
							{{-- Right (Author, Comments) --}}
							<div>
								<div class="d-flex align-items-center">
									<div class="ml-4">
										<span class="text-muted">Employer</span><br>
										<a class="fw-bold" href="/companies/{{ $job->company->code }}">{{ $job->company->company_name }}</a>
										<br>
									</div>
									<div class="ml-4">
										<span class="text-muted">Company</span><br>
										<a class="fw-bold" href="/companies/{{ $job->company->code }}">{{ $job->company->company_name }}</a>
										<br>
									</div>
									<div class="ml-4">
										<span class="text-muted">Budget</span><br>
										<span class="fw-bold">&#8369;{{ $job->salary_min }} - &#8369;{{ $job->salary_max }}</span>
										<br>
									</div>
								</div>
							</div>
						</div>
						<div class="blog-card__body">
							<div class="blog-card__body-text ckeditor-container">{!! $job->description !!}</div>
						</div>
						<div class="mt-4">
							@if ($job->job_classifications != null)
								@foreach ($job->job_classifications as $classification)
									<span class="badge badge-pill badge-light -hvr_green">{{ $classification->classification->name }}</span>&ensp;
								@endforeach
							@else
									<span class="badge badge-pill badge-light -hvr_green">No classification</span>&ensp;
							@endif
						</div>

						<hr>

						<div>
							<div class="job-post__qualifications">
								<p class="mb-2 text-muted fw-bold">Qualifications</p>
								@if ($job->job_qualification)
								<ul>
									<li class="text-muted fw-500 mb-1">Professional:&ensp;{!! ($job->job_qualification->professional) ? '<i class="fas fa-check-circle"></i>' : '<i class="far fa-check-circle"></i>' !!}</li>
									<li class="text-muted fw-500 mb-1">
										Contractor:&ensp;{!! ($job->job_qualification->contractor) ? '<i class="fas fa-check-circle"></i>' : '<i class="far fa-check-circle"></i>' !!}
									</li>
									<li class="text-muted fw-500 mb-1">
										Supplier:&ensp;{!! ($job->job_qualification->supplier) ? '<i class="fas fa-check-circle"></i>' : '<i class="far fa-check-circle"></i>' !!}
									</li>
								</ul>
								@endif
							</div>
						</div>
					</div>
				@else
					<div class="blog-card">
						<div>
							<div>
								<span class="fw-500">Job</span> &#8231;
								<span class="text-muted">
									{{ \Carbon\Carbon::parse($job->created_at)->diffForHumans().' at '.\Carbon\Carbon::parse($job->created_at)->format('g:i A') }}
								</span>
							</div>
							<div class="my-2 d-flex">
								<h2 class="flex-grow-1">{{ $job->title }}</h2>
								<div class="float-right">
									@if ($job_entry !== null && $job_entry->status === 'accepted')
										<button class="btn-w-icon -yellow mr-2" data-toggle="modal" data-target="{{ ($job_review !== null) ? '#reviewUpdateModal' : '#reviewModal' }}" onclick="passJobEntryId({{ $job_entry->id }})">
											<div class="btn-w-icon__logo">
												<i class="fas fa-star"></i>
											</div>
											<div class="btn-w-icon__triangle"></div>
											<div class="btn-w-icon__text">Review</div>
										</button>
									@endif
								</div>
							</div>
						</div>
						<div class="blog-card__profile">
							{{-- Left (Profile) --}}
							<div>
								<div class="container--img-border overflow-hidden rounded-circle" style="height: 70px; width: 70px">
									<img src="/storage/images/profile-images/{{ $job->professional->image ?? 'default.png' }}" class="img--responsive" alt="{{ $job->professional->image }}">
								</div>
							</div>
							{{-- Right (Author, Comments) --}}
							<div>
								<div class="d-flex align-items-center">
									<div class="ml-4">
										<span class="text-muted">Employer</span><br>
										<a class="fw-bold" href="/profile/{{ $job->professional->username }}">{{ $job->professional->first_name.' '.$job->professional->last_name }}</a>
										<br>
									</div>
									<div class="ml-4">
										<span class="text-muted">Company</span><br>
										<span class="fw-bold">N/A</span>
										<br>
									</div>
									<div class="ml-4">
										<span class="text-muted">Budget</span><br>
										<span class="fw-bold">&#8369;{{ $job->salary_min }} - &#8369;{{ $job->salary_max }}</span>
										<br>
									</div>
								</div>
							</div>
						</div>
						<div class="blog-card__body">
							<div class="blog-card__body-text ckeditor-container">{!! $job->description !!}</div>
						</div>
						<div class="mt-4">
							@if ($job->job_classifications != null)
								@foreach ($job->job_classifications as $classification)
									<span class="badge badge-pill badge-light -hvr_green">{{ $classification->classification->name }}</span>&ensp;
								@endforeach
							@else
									<span class="badge badge-pill badge-light -hvr_green">No classification</span>&ensp;
							@endif
						</div>

						<hr>

						<div>
							<div class="job-post__qualifications">
								<p class="mb-2 text-muted fw-bold">Qualifications</p>
								@if ($job->job_qualification)
								<ul>
									<li class="text-muted fw-500 mb-1">Professional:&ensp;{!! ($job->job_qualification->professional) ? '<i class="fas fa-check-circle"></i>' : '<i class="far fa-check-circle"></i>' !!}</li>
									<li class="text-muted fw-500 mb-1">
										Contractor:&ensp;{!! ($job->job_qualification->contractor) ? '<i class="fas fa-check-circle"></i>' : '<i class="far fa-check-circle"></i>' !!}
									</li>
									<li class="text-muted fw-500 mb-1">
										Supplier:&ensp;{!! ($job->job_qualification->supplier) ? '<i class="fas fa-check-circle"></i>' : '<i class="far fa-check-circle"></i>' !!}
									</li>
								</ul>
								@endif
							</div>
						</div>
						
						@if ($job_review !== null)
						<div class="mt-3 pt-3" style="border-top: 2px solid #eeeeee">
							<p class="mb-2 text-muted fw-bold">Review</p>
							<div class="row">
								<div class="col-md-9">
									<div>{!! $job_review->description !!}</div>
								</div>
								<div class="col-md-3 text-center">
									<div>
										@if ($job_review->rate < 1)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_review->rate < 1)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_review->rate >= 1)
										<i class="fas fa-star review-star"></i>
										@endif
										@if($job_review->rate == 1.5)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_review->rate < 2 && $job_review->rate != 1.5)
										<i class="far fa-star review-star"></i>
										@endif
										@if($job_review->rate >= 2)
										<i class="fas fa-star review-star"></i>
										@endif
										@if($job_review->rate == 2.5)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_review->rate < 3 && $job_review->rate != 2.5)
										<i class="far fa-star review-star"></i>
										@endif
										@if($job_review->rate >= 3)
										<i class="fas fa-star review-star"></i>
										@endif
										@if($job_review->rate == 3.5)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_review->rate < 4 && $job_review->rate != 3.5)
										<i class="far fa-star review-star"></i>
										@endif
										@if($job_review->rate >= 4)
										<i class="fas fa-star review-star"></i>
										@endif
										@if($job_review->rate == 4.5)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_review->rate < 5 && $job_review->rate != 4.5)
										<i class="far fa-star review-star"></i>
										@endif
										@if($job_review->rate == 5)
										<i class="fas fa-star review-star"></i>
										@endif
									</div>
									<span class="fw-500 text-muted">{{ $job_review->rate }}% Rating</span>
								</div>
							</div>
						</div>
						@endif
					</div>
				@endif
			</div>
		</div>
		{{-- / Job Information --}}
		<div class="col-md-3">
			<button class="btn -bleached btn-block fw-bold"><i class="fas fa-flag"></i>&ensp;Save</button>
		</div>
	</div>

	{{-- Proposal Form --}}
	<div class="row mb-5">
		<div class="col-md-9">
			<div class="panel" style="border-radius: 15px;">
				<div class="panel__header col">
					<h3 class="panel__title">
						Proposal
					</h3>
					<div class="panel__header-line"></div>
				</div>
				<hr class="my-0" style="margin-left: 2rem; margin-right: 2rem;">
				<div class="panel__body">
					{{-- Check if the user has job entry --}}
					@if (!is_null($job_entry))
						@if ($job_entry->entity_type === 1)
							<div class="row">
								<div class="col-1">
									<div class="container--img-border overflow-hidden rounded-circle" style="height: 50px; width: 50px">
										@if (!is_null($job_entry->professional->image))
										<img src="/storage/images/profile-images/{{ $job_entry->professional->image }}" class="img--responsive" alt="{{ $job_entry->professional->username }}">
										@else
										<img src="/storage/images/profile-images/default.png" class="img--responsive" alt="{{ $job_entry->professional->username }}">
										@endif
									</div>
								</div>
								<div class="col-11 pl-4">
									<p class="float-left">
										<a href="/profile/{{ $job_entry->professional->username }}">{{ $job_entry->professional->first_name.' '.$job_entry->professional->last_name }}</a> &#8231; <small class="text-muted">{{ \Carbon\Carbon::parse($job_entry->created_at)->diffForHumans() }} at {{ \Carbon\Carbon::parse($job_entry->created_at)->format('g:i A') }}</small>
										<br>
										<span class="fw-500">Company: N/A</span>
									</p>
									@if (!is_null($job_entry))
									<div class="float-right pt-1" style="display: flex; justify-content: center; align-items: baseline;">
										@if ($job_entry->status == 'pending')
											@include('components.btn-w-icon', [
												'class' => '-lime',
												'attr'  => 'data-toggle=modal data-target=#exampleModal',
												'icon'  => '<i class="fas fa-pen"></i>',
												'text'  => 'Edit'
											])
										@elseif($job_entry->status == 'accepted')
											@include('components.btn-w-icon', [
												'class' => '-blue mr-2',
												'attr'  => null,
												'icon'  => '<i class="fas fa-heart"></i>',
												'text'  => 'Accepted'
											])
										@else
											@include('components.btn-w-icon', [
												'class' => '-red',
												'attr'  => null,
												'icon'  => '<i class="fas fa-exclamation"></i>',
												'text'  => 'Declined'
											])
										@endif
									</div>
									@endif
								</div>
							</div>
						@elseif ($job_entry->entity_type === 2)
							<div class="row">
								<div class="col-1">
									<div class="container--img-border overflow-hidden rounded-circle" style="height: 50px; width: 50px">
										@if (!is_null($job_entry->company->logo))
										<img src="/storage/images/profile-images/{{ $job_entry->company->logo }}" class="img--responsive" alt="{{ $job_entry->company->company_name }}">
										@else
										<img src="/storage/images/profile-images/default.png" class="img--responsive" alt="{{ $job_entry->company->company_name }}">
										@endif
									</div>
								</div>
								<div class="col-11 pl-4">
									<p class="float-left">
										<a href="/profile/{{ $job_entry->company->user->username }}">{{ $job_entry->company->user->first_name.' '.$job_entry->company->user->last_name }}</a> &#8231; <small class="text-muted">{{ $job_entry->created_at->diffForHumans() }} at {{ $job_entry->created_at->format('g:i A') }}</small>
										<br>
										<span class="fw-500">Company: <a href="/companies/{{ $job_entry->company->code }}">{{ $job_entry->company->company_name }}</a></span>
									</p>
									@if (!is_null($job_entry))
									<div class="float-right pt-1" style="display: flex; justify-content: center; align-items: baseline;">
										@if ($job_entry->status == 'pending')
											@include('components.btn-w-icon', [
												'class' => '-lime',
												'attr'  => 'data-toggle=modal data-target=#exampleModal',
												'icon'  => '<i class="fas fa-pen"></i>',
												'text'  => 'Edit'
											])
										@elseif($job_entry->status == 'accepted')
											@include('components.btn-w-icon', [
												'class' => '-blue mr-2',
												'attr'  => null,
												'icon'  => '<i class="fas fa-heart"></i>',
												'text'  => 'Accepted'
											])
										@else
											@include('components.btn-w-icon', [
												'class' => '-blue',
												'attr'  => null,
												'icon'  => '<i class="fas fa-exclamation"></i>',
												'text'  => 'Declined'
											])
										@endif
									</div>
									@endif
								</div>
							</div>
						@endif
						<div class="statement-body mt-2 w-75">
							<p class="mb-1 fw-bold text-muted">Proposal</p>
							{!! $job_entry->proposal !!}
						</div>
						<div class="mt-2 w-75">
							@forelse($job_entry->company->other_classifications as $classification)
								<span class="badge badge-pill badge-light -hvr_green">{{ $classification->name }}</span>&ensp;
							@empty
								<span class="badge badge-pill badge-light -hvr_green">No data to show</span>&ensp;
							@endforelse
						</div>
						<div class="mt-3">
							<p class="mb-1 fw-bold text-muted">Review</p>
							@if ($job_entry !== null && $job_entry->review !== null)
							<div class="row">
								<div class="col-md-9">
									<div>{!! $job_entry->review->description !!}</div>
								</div>
								<div class="col-md-3 text-center">
									<div>
										@if ($job_entry->review->rate === 0)
										<i class="far fa-star review-star"></i>
										@endif
										@if($job_entry->review->rate == 0.5)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_entry->review->rate >= 1)
										<i class="fas fa-star review-star"></i>
										@endif
										@if($job_entry->review->rate == 1.5)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_entry->review->rate < 2 && $job_review->rate != 1.5)
										<i class="far fa-star review-star"></i>
										@endif
										@if($job_entry->review->rate >= 2)
										<i class="fas fa-star review-star"></i>
										@endif
										@if($job_entry->review->rate == 2.5)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_entry->review->rate < 3 && $job_review->rate != 2.5)
										<i class="far fa-star review-star"></i>
										@endif
										@if($job_entry->review->rate >= 3)
										<i class="fas fa-star review-star"></i>
										@endif
										@if($job_entry->review->rate == 3.5)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_entry->review->rate < 4 && $job_entry->review->rate != 3.5)
										<i class="far fa-star review-star"></i>
										@endif
										@if($job_entry->review->rate >= 4)
										<i class="fas fa-star review-star"></i>
										@endif
										@if($job_entry->review->rate == 4.5)
										<i class="fas fa-star-half-alt review-star"></i>
										@endif
										@if($job_entry->review->rate < 5 && $job_entry->review->rate != 4.5)
										<i class="far fa-star review-star"></i>
										@endif
										@if($job_entry->review->rate == 5)
										<i class="fas fa-star review-star"></i>
										@endif
									</div>
									<span class="fw-500 text-muted">{{ $job_entry->review->rate }}% Rating</span>
								</div>
							</div>
							@else
								<p>No data to show</p>
							@endif
						</div>
					{{-- / Check if the user has job entry --}}
					@else
					{{-- Check if the user has no job entry --}}
						<form method="post" action="/jobs/{{ $job->code }}/apply">
							@csrf
							@if (session('user_type') == 4)
								@if ($companies != null)
									<div class="form-group -label-bold">
										<label>Company</label>
										<select name="entity_id" class="form-control select2-companies" required="required">
											<option></option>
											@foreach ($companies as $company)
												<option value="{{ $company->id }}">{{ $company->company_name }}</option>
											@endforeach
										</select>
										<small class="text-muted">If you don't have company, please <a class="small-like" href="/companies/create" target="_blank">create here</a>.</small>
									</div>
									<input type="hidden" name="entity_type" value="2">
								@endif
							@else
								<input type="hidden" name="entity_type" value="1">
								<input type="hidden" name="entity_id" value="{{ session('user_id') }}">
							@endif

							<div class="form-group -label-bold">
								<label>Proposal</label>
								<textarea class="form-control" name="proposal"></textarea>
							</div>
							<hr class="cstm-hr">
							<div class="form-group -label-bold">
								<button class="btn -submit">Submit</button>
								<a href="/jobs" class="btn -back">Go back</a>
							</div>
						</form>
					{{-- Check if the user has no job entry --}}
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('modal')
@if (!is_null($job_entry))
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="reviewModalLabel">Edit proposal</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form action="/jobs/{{ $job->code }}/apply/{{ $job_entry->id }}" method="post">
			<div class="modal-body">
				@csrf
				@method('put')
				@if ( session('user_type') == 4 )
				@if ($companies != null)
				<div class="form-group">
					<label class="fw-bold">Company</label><br>
					<select name="entity_id" class="form-control select2-modal-companies" required="required">
						<option></option>
						@foreach ($companies as $company)
						<option value="{{ $company->id }}">{{ $company->company_name }}</option>
						@endforeach
					</select><br>
				</div>
				@endif
				@else
				<input type="hidden" name="entity_id" value="{{ session('user_id') }}">
				@endif

				<div class="form-group -label-bold">
					<label>Proposal</label>
					<textarea class="form-control" name="proposal_update" cols="30" rows="7">{{ $job_entry->proposal }}</textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn -back" data-dismiss="modal">Back</button>
				<button class="btn -submit">Submit</button>
			</div>
		</form>
	</div>
</div>
	</div>
@endif
{{-- Review modal --}}
@if ($job_review === null)
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="reviewModalLabel">Review</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/applicant/reviews" method="post">
				<div class="modal-body">
					@csrf

					<input type="hidden" name="job_id" value="{{ $job->id }}">
					<input type="hidden" id="jobEntryId" name="job_entry_id">

					<div class="form-group">
						<label class="fw-bold" for="">Stars</label>
						<div class="rating">
							<input type="radio" id="star5" name="rate" value="5">
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>

							<input type="radio" id="star4half" name="rate" value="4.5">
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

							<input type="radio" id="star4" name="rate" value="4">
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>

							<input type="radio" id="star3half" name="rate" value="3.5">
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>

							<input type="radio" id="star3" name="rate" value="3">
							<label class = "full" for="star3" title="Meh - 3 stars"></label>

							<input type="radio" id="star2half" name="rate" value="2.5">
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

							<input type="radio" id="star2" name="rate" value="2">
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

							<input type="radio" id="star1half" name="rate" value="1.5">
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>

							<input type="radio" id="star1" name="rate" value="1">
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>

							<input type="radio" id="starhalf" name="rate" value="0.5">
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
						</div>
					</div>

					<div class="form-group">
						<label class="fw-bold">Description</label>
						<textarea class="form-control" name="description" cols="30" rows="7"></textarea>
					</div>

				</div>
				<div class="modal-footer">
					<button class="btn -submit">Submit</button>
					<button type="button" class="btn -back" data-dismiss="modal">Go back</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endif
{{-- / Review modal --}}
{{-- Update review modal --}}
@if ($job_review !== null)
<div class="modal fade" id="reviewUpdateModal" tabindex="-1" role="dialog" aria-labelledby="reviewUpdateModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="reviewUpdateModalLabel">Review</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/applicant/reviews/{{ $job_review->id }}" method="post">
				<div class="modal-body">
					@csrf
					@method('PUT')

					<div class="form-group">
						<label class="fw-bold" for="">Stars</label>
						<div class="rating">
							<input type="radio" id="star5-{{ $job_review->id }}" name="rate" value="5" {{ ($job_review->rate === 5) ? 'checked="checked"' : null }}>
							<label class = "full" for="star5-{{ $job_review->id }}" title="Awesome - 5 stars"></label>

							<input type="radio" id="star4half-{{ $job_review->id }}" name="rate" value="4.5" {{ ($job_review->rate === 4.5) ? 'checked="checked"' : null }}>
							<label class="half" for="star4half-{{ $job_review->id }}" title="Pretty good - 4.5 stars"></label>

							<input type="radio" id="star4-{{ $job_review->id }}" name="rate" value="4" {{ ($job_review->rate === 4) ? 'checked="checked"' : null }}>
							<label class = "full" for="star4-{{ $job_review->id }}" title="Pretty good - 4 stars"></label>

							<input type="radio" id="star3half-{{ $job_review->id }}" name="rate" value="3.5" {{ ($job_review->rate === 3.5) ? 'checked="checked"' : null }}>
							<label class="half" for="star3half-{{ $job_review->id }}" title="Meh - 3.5 stars"></label>

							<input type="radio" id="star3-{{ $job_review->id }}" name="rate" value="3" {{ ($job_review->rate === 3) ? 'checked="checked"' : null }}>
							<label class = "full" for="star3-{{ $job_review->id }}" title="Meh - 3 stars"></label>

							<input type="radio" id="star2half-{{ $job_review->id }}" name="rate" value="2.5" {{ ($job_review->rate === 2.5) ? 'checked="checked"' : null }}>
							<label class="half" for="star2half-{{ $job_review->id }}" title="Kinda bad - 2.5 stars"></label>

							<input type="radio" id="star2-{{ $job_review->id }}" name="rate" value="2" {{ ($job_review->rate === 2) ? 'checked="checked"' : null }}>
							<label class = "full" for="star2-{{ $job_review->id }}" title="Kinda bad - 2 stars"></label>

							<input type="radio" id="star1half-{{ $job_review->id }}" name="rate" value="1.5" {{ ($job_review->rate === 1.5) ? 'checked="checked"' : null }}>
							<label class="half" for="star1half-{{ $job_review->id }}" title="Meh - 1.5 stars"></label>

							<input type="radio" id="star1-{{ $job_review->id }}" name="rate" value="1" {{ ($job_review->rate === 1) ? 'checked="checked"' : null }}>
							<label class = "full" for="star1-{{ $job_review->id }}" title="Sucks big time - 1 star"></label>

							<input type="radio" id="starhal-{{ $job_review->id }}f" name="rate" value="0.5" {{ ($job_review->rate === 0.5) ? 'checked="checked"' : null }}>
							<label class="half" for="starhalf-{{ $job_review->id }}" title="Sucks big time - 0.5 stars"></label>
						</div>
					</div>

					<div class="form-group">
						<label class="fw-bold">Description</label>
						<textarea class="form-control" name="description" id="updateDescription" cols="30" rows="7">{{ $job_review->description }}</textarea>
					</div>

				</div>
				<div class="modal-footer">
					<button class="btn -submit">Submit</button>
					<button type="button" class="btn -back" data-dismiss="modal">Go back</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endif
{{-- / Update review modal --}}
@endpush

@push('scripts')
<script>
	function passJobEntryId(id){
		$('#jobEntryId').val(id);
	}
	CKEDITOR.replace('proposal');
	CKEDITOR.replace('proposal_update');
	CKEDITOR.replace('description');
	CKEDITOR.replace(document.getElementById('updateDescription'));
</script>
@endpush