@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9 profile-left">
      <!-- Profile -->
      <section class="profile-section">
        <div class="row">
          <div class="col-md-8 profile__left-left">
            <div class="card">
              <div class="row no-gutters">
                <div class="col-auto profile__img-container" onmouseover="showProfileImageButton()" onmouseout="hideProfileImageButton()">
                 @if ($user->image !== null)
                 <img class="img-responsive" src="/storage/images/profile-images/{{ $user->image }}" alt="{{ $user->image }}">
                 @else
                 <img class="img-responsive" src="/storage/images/profile-images/default.png" alt="default-avatar">
                 @endif

                 <div class="profile-image__btn-container" id="profile-image__btn-container">
                   @if (session('user_id') && session('user_id') === $user->id)
                   <span class="pointer fw-bold">
                     <a data-toggle="modal" data-target="#profileImageModal"><i class="fas fa-camera"></i></a>
                   </span>  
                   @endif
                 </div>
               </div>
               <div class="col profile__name-container">
                <div class="card-block px-2">
                  <h3>{{ $user->first_name.' '.$user->last_name }}</h3>
                  <p class="profile-address"><i class="fas fa-map-marker-alt"></i>&ensp;
                   @if ($user->city !== null && $user->region !== null)
                   {{ $user->city->name.', '.$user->region->name }}
                   @else
                   No data to show
                   @endif
                    <a href="#" data-toggle="modal" data-target="#addressModal">
                      <i class="fas fa-pen"></i>
                    </a>
                 </p>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="col-md-4 profile__left-right">
        <div class="profile-left-right__rating">
          @if ($ratings_average === 0)
          <i class="far fa-star profile-left-right__rating-star"></i>
          @endif
          @if ($ratings_average == 0.5)
          <i class="fas fa-star-half-alt profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average >= 1)
          <i class="fas fa-star profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average == 1.5)
          <i class="fas fa-star-half-alt profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average < 2 && $ratings_average != 1.5)
          <i class="far fa-star profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average >= 2)
          <i class="fas fa-star profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average == 2.5)
          <i class="fas fa-star-half-alt profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average < 3 && $ratings_average != 2.5)
          <i class="far fa-star profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average >= 3)
          <i class="fas fa-star profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average == 3.5)
          <i class="fas fa-star-half-alt profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average < 4 && $ratings_average != 3.5)
          <i class="far fa-star profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average >= 4)
          <i class="fas fa-star profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average == 4.5)
          <i class="fas fa-star-half-alt profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average < 5 && $ratings_average != 4.5)
          <i class="far fa-star profile-left-right__rating-star"></i>
          @endif
          @if($ratings_average == 5)
          <i class="fas fa-star review-star"></i>
          @endif
        </div>
        <p><b>{{ $ratings_average }}% Rating(s)</b> | <span class="profile__left-right-reviews">{{ count($user->reviews) }} Review(s)</span></p>
      </div>
    </div>
    <div class="profile-overview">
      <div class="profile-overview__header">
        <h5><i class="far fa-user-circle"></i>&ensp;Overview</h5>
        <hr class="cstm-hr">
      </div>
      <div class="profile-overview__profession">
        <p>
          @if ($user->classification !== null)
          <span class="profile__overview-classification">{{ $user->classification->classification->name }}</span>
          @else
          <span class="profile__overview-classification">No data to show</span>
          @endif
          @if (session('user_id') && session('user_id') === $user->id)
          <a href="#" data-toggle="modal" data-target="#professionModal">
            <i class="fas fa-pen"></i>
          </a>
          @endif
        </p>
      </div>
      <div class="profile-overview__content">
        <div class="row">
          <div class="col-md-11 col-md-11--profile-overview">
           @if ($user->preference !== null && $user->preference->summary !== null)
           <p>{!! $user->preference->summary !!}</p>
           @else
           <p>Tell your clients about yourself.</p>
           @endif
         </div>
         <div class="col-md-1 profile__overview-edit">
          @if (session('user_id') && session('user_id') === $user->id)
          <button class="btn -lime-outline -circle" data-toggle="modal" data-target="#overviewModal">
            <i class="fas fa-pen"></i>
          </button>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Profile -->
{{-- Posted Jobs --}}
<section class="profile-section">
  <div class="section__head">
    <div class="d-flex">
      <h5 class="flex-grow-1"><i class="fas fa-tasks"></i>&ensp;Jobs (Posted)</h5>
      <div style="margin-top: -5px">
        <a class="btn -circle -lime-outline" href="/jobs/create">
          <i class="fas fa-plus"></i>
        </a>
      </div>
    </div>
    <hr class="cstm-hr">
  </div>
  <div class="section__content">
    @forelse($user->job_posts->chunk(2) as $chunk)
    <div class="row">
      @foreach ($chunk as $job)
        <div class="col-md-6">
        <div class="job-card">
          <div class="d-flex">
            <div class="d-flex align-items-center justify-content-center" style="color: #a7cb00; background-color: rgb(166, 203, 0, 0.2); border-radius: 50%; width: 50px; height: 50px;">
              @switch($job->status)
              @case('hiring')
              <i class="far fa-handshake"></i>
              @break
              @case('ongoing')
              <i class="far fa-hourglass"></i>
              @break
              @case('done')
              <i class="fas fa-check"></i>
              @break
              @endswitch
            </div>
            <div class="ml-3">
              <small class="text-muted">Budget</small><br>
              <small class="fw-bold">&#8369;{{ $job->salary_min }} - &#8369;{{ $job->salary_max }}</small>
              <br>
            </div>
            <div class="ml-3">
              <small class="text-muted">Job Post</small><br>
              <a class="fw-bold text-decoration-none" href="/jobs/{{ $job->code }}"><small>Go to job post</small></a>
              <br>
            </div>
          </div>
          <div class="mt-3">
            <h5 class="mt-2 mb-1">{{ $job->title }}</h5>
            <div class="mb-3 job-post-description ckeditor-container">{!! $job->description !!}</div>
            <small>Deadline: {{ $job->deadline->format('M d, Y') }}</small>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @empty
    <div class="mt-4">
      <p>No data to show</p>
    </div>
    @endforelse
  </div>
</section>
{{-- / Jobs --}}
<!-- Reviews -->
<section class="profile-section {{ $user->isClient() ? 'mb-5' : null }}">
  <div class="section__head">
    <div class="row">
      <div class="col">
        <h5><i class="far fa-comments"></i>&ensp;Reviews</h5>
      </div>
    </div>
    <hr class="cstm-hr">
  </div>
  @forelse($user->reviews as $review)
  <div class="clean-container px-2">
   <p class="clean-container-title mb-2">{{ $review->job->title }}</p>
   <p class="clean-container-text">
    @if ($review->rate === 0)
    <i class="far fa-star review-star"></i>
    @endif
    @if ($review->rate == 0.5)
    <i class="fas fa-star-half-alt review-star"></i>
    @endif
    @if($review->rate >= 1)
    <i class="fas fa-star review-star"></i>
    @endif
    @if($review->rate == 1.5)
    <i class="fas fa-star-half-alt review-star"></i>
    @endif
    @if($review->rate < 2 && $review->rate != 1.5)
    <i class="far fa-star review-star"></i>
    @endif
    @if($review->rate >= 2)
    <i class="fas fa-star review-star"></i>
    @endif
    @if($review->rate == 2.5)
    <i class="fas fa-star-half-alt review-star"></i>
    @endif
    @if($review->rate < 3 && $review->rate != 2.5)
    <i class="far fa-star review-star"></i>
    @endif
    @if($review->rate >= 3)
    <i class="fas fa-star review-star"></i>
    @endif
    @if($review->rate == 3.5)
    <i class="fas fa-star-half-alt review-star"></i>
    @endif
    @if($review->rate < 4 && $review->rate != 3.5)
    <i class="far fa-star review-star"></i>
    @endif
    @if($review->rate >= 4)
    <i class="fas fa-star review-star"></i>
    @endif
    @if($review->rate == 4.5)
    <i class="fas fa-star-half-alt review-star"></i>
    @endif
    @if($review->rate < 5 && $review->rate != 4.5)
    <i class="far fa-star review-star"></i>
    @endif
    @if($review->rate == 5)
    <i class="fas fa-star review-star"></i>
    @endif
  </p>
  <div class="clean-container-text">{!! $review->description !!}</div>
  <p class="clean-container-text">
    <span class="fw-500">From: </span>
    @if ($review->job_entry->job->isFromCompany())
    <a href="/companies/{{ $review->job_entry->job->company->code }}">
      {{ $review->job_entry->job->company->company_name }}
    </a>
    @elseif ($review->job_entry->job->isFromProfessional())
    <a href="/profile/{{ $review->job_entry->job->professional->username }}">
      {{ $review->job_entry->job->professional->first_name.' '.$review->job_entry->job->professional->last_name }}
    </a>
    @else
    <a href="/profile/{{ $review->job_entry->job->client->username }}">
      {{ $review->job_entry->job->client->first_name.' '.$review->job_entry->job->client->last_name }}
    </a>
    @endif
  </p>
  <p class="clean-container-year">{{ $review->job_entry->updated_at->format('M Y') }}</p>
</div>
@empty
<div class="mt-4">
 <p>No data to show</p>
</div>
@endforelse
</section>
<!-- / Reviews -->
</div>
<div class="col-md-3 profile-right">
  <a class="btn -bleached btn-block fw-bold" href="/settings/personal-info">
    Personal Info
  </a>
  <div class="profile-basic-info position-sticky" style="top: 1.5rem">
    {{-- Contacts --}}
    <div class="my-4 px-3">
      <h4 class="fw-bold mb-4">Contacts</h4>
      <ul>
        <li class="text-muted mb-3"><i class="far fa-envelope"></i>&ensp;{{ $user->email ?? 'No data to show' }}</li>
        <li class="text-muted mb-3"><i class="fas fa-mobile-alt"></i>&ensp;{{ $user->mobile_number ?? 'No data to show' }}</li>
        <li class="text-muted mb-3"><i class="fas fa-phone"></i>&ensp;{{ $user->phone_number ?? 'No data to show' }}</li>
        <li class="text-muted mb-3"><i class="fas fa-fax"></i>&ensp;{{ $user->fax_number ?? 'No data to show' }}</li>
      </ul>
    </div>
    {{-- / Contacts --}}
    <hr>
    {{-- Profile link --}}
    <div class="my-4 px-3">
      <h4 class="fw-bold mb-4">Profile Link</h4>
      <input class="form-control" type="text" id="profileLink" value="{{ url()->current() }}" disabled>
      <a class="mt-3" href="#" onclick="copyProfileLink()"><small>Copy link</small></a>
    </div>
  </div>
</div>
</div>
</div>
@endsection