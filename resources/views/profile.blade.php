@extends('layouts.app')

@section('styles')
<style>
	.review-star{
		color: #FFC000;
		font-size: 18px;
	}

	#my_camera{
		width: 640px;
		height: 480px;
	}

	#my_camera video{
		width: 640px;
		height: 480px;
	}

  .job-post-description > p{
    color: #6c757d;
    line-height: 1.6;
  }
</style>
@endsection

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
<!-- Specialties -->
@if (!$user->isClient())
<section class="profile-section">
  <div class="section__head">
    <div class="row">
      <div class="col">
        <h5><i class="fas fa-chart-line"></i>&ensp;Specialties</h5>
      </div>
      @if (session('user_id') && session('user_id') === $user->id)
      <span class="col text-right">
        <button class="btn -lime-outline -circle" data-toggle="modal" data-target="##specialtiesModal">
          <i class="fas fa-pen"></i>
        </button>
      </span>
      @endif
    </div>
    <hr class="cstm-hr">
  </div>
  <div class="section__content">
    @forelse($user->other_classifications as $classification)
    <span class="badge badge-pill badge-light -hvr_green">{{ $classification->classification->name }}</span>&ensp;
    @empty
    <div class="mt-4">
      <p>No data to show</p>
    </div>
    @endforelse
  </div>
</section>
@endif
<!-- / Specialties -->
{{-- Jobs --}}
<section class="profile-section">
  <div class="section__head">
    <div class="d-flex">
      <h5 class="flex-grow-1"><i class="fas fa-tasks"></i>&ensp;Jobs</h5>
      <div></div>
    </div>
    <hr class="cstm-hr">
  </div>
  <div class="section__content">
    @forelse($user->job_posts as $job)
    <div class="row">
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
            <div class="mb-3 job-post-description">{!! $job->description !!}</div>
            <small>Deadline: {{ $job->deadline->format('M d, Y') }}</small>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div class="mt-4">
      <p>No data to show</p>
    </div>
    @endforelse
  </div>
</section>
{{-- / Jobs --}}
{{-- Posted Jobs --}}
<section class="profile-section">
  <div class="section__head">
    <div class="d-flex">
      <h5 class="flex-grow-1"><i class="fas fa-tasks"></i>&ensp;Posted jobs</h5>
      <div>
        <a class="btn -circle -lime-outline" href="/jobs/create">
          <i class="fas fa-plus"></i>
        </a>
      </div>
    </div>
    <hr class="cstm-hr">
  </div>
  <div class="section__content">
    @forelse($user->job_posts as $job)
    <div class="row">
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
            <div class="mb-3 job-post-description">{!! $job->description !!}</div>
            <small>Deadline: {{ $job->deadline->format('M d, Y') }}</small>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div class="mt-4">
      <p>No data to show</p>
    </div>
    @endforelse
  </div>
</section>
{{-- / Jobs --}}
<!-- Projects -->
@if (!$user->isClient())
<section class="profile-section">
  <div class="section__head">
    <div class="row">
      <div class="col">
        <h5><i class="far fa-building"></i>&ensp;Projects</h5>
      </div>
    </div>
    <hr class="cstm-hr">
  </div>
  <div class="section__content">
   @if (session('user_id') && session('user_id') === $user->id)
   <div class="col-md-4">
     <div class="project-container__add" onmouseover="addProjectHover()">
      <a href="/projects/create" id="project-add" ><i class="fas fa-plus-circle"></i></a>
    </div>
  </div>
  @endif
  @if ($user->projects !== null)
  <div class="row">
   @foreach ($user->projects as $key => $project)
   <div class="col-md-4 cstm-mb-2">
    <div class="project-container" onmouseover="projectHover($key)" onmouseout="projectRemoveHover($key)">
     <div class="project-body mb-2">
      <div class="project-img-container">
       <img src="/storage/images/projects/cover-images/{{ $project->image }}" alt="{{ $project->image }}">
     </div>
     <div class="project__options" id="project-options{{ $key }}">
       <a href="#" title="Edit"><i class="far fa-edit"></i></a>&ensp;
       <a href="/projects/{{ $project->code }}" title="View"><i class="fas fa-eye"></i></a>&ensp;
       <a href="#" title="Delete"><i class="far fa-trash-alt"></i></a>
     </div>
   </div>
   <div class="project-footer">
    <small class="fw-bold">{{ $project->name }}</small>
  </div>
</div>
</div>
@endforeach						
</div>
@else
<div class="row">
 @if (session('user_id') && session('user_id') === $user->id)
 <div class="col-md-4">
   <div class="project-container__add" onmouseover="addProjectHover()">
    <a href="/projects/create" id="project-add" ><i class="fas fa-plus-circle"></i></a>
  </div>
</div>
<div v-else class="ml-3">
 <p>No data to show</p>
</div>
@endif
</div>
@endif
</div>
</section>
@endif
<!-- / Projects -->
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
<!-- Emperience -->
<section class="profile-section" id="worksSection">
  <div class="section__head">
    <div class="row">
      <div class="col d-flex">
        <h5 class="flex-grow-1">
          <i class="fas fa-briefcase"></i>&ensp;Experience
        </h5>
        <button class="btn -lime-outline -circle" data-toggle="modal" data-target="#experienceModal">
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
    <hr class="cstm-hr mb-0">
  </div>
  @forelse($user->experiences as $experience)
  <div class="clean-container px-2">
   <p class="clean-container-title mb-3">{{ $experience->job_title }} | {{ $experience->company }}</p>
   <p class="clean-container-text">
    <span class="d-block -bold">Responsibilities:</span>
    {!! $experience->responsibilities !!}
  </p>
  <p class="clean-container-text">
    <span class="d-block -bold">Accomplishments:</span>
    {!! $experience->accomplishments !!}
  </p>
  <p class="clean-container-text">
    <span class="d-block -bold">Skills:</span>
    {!! $experience->skills !!}
  </p>
  <p class="clean-container-year mt-3">
    {{ $experience->started_at->format('Y M').' - '.$experience->ended_at->format('Y M') }}
  </p>
</div>
@empty
<div class="mt-4">
 <p>No data to show</p>
</div>
@endforelse
</section>
<!-- / Emperience -->
<!-- Education -->
<section class="profile-section" id="educationsSection">
  <div class="section__head">
    <div class="row">
      <div class="col d-flex">
        <h5 class="flex-grow-1"><i class="fas fa-graduation-cap"></i>&ensp;Education</h5>
        <button class="btn -lime-outline -circle" data-toggle="modal" data-target="#educationModal">
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
    <hr class="cstm-hr mb-0">
  </div>
  @forelse($user->educations as $education)
  <div class="clean-container px-2">
   <h5 class="clean-container-title">{{ $education->degree.' | '.$education->field }}</h5>
   <p class="clean-container-sub-title">{{ $education->school }}</p>
   <p class="clean-container-year">{{ $education->started_at->format('Y') }} - {{  $education->ended_at->format('Y') }}</p>
 </div>
 @empty
 <div class="mt-4">
   <p>No data to show</p>
 </div>
 @endforelse
</section>
<!-- / Education -->
<!-- Licensures -->
@if (!$user->isClient())
<section class="profile-section" id="licensuresSection">
  <div class="section__head">
    <div class="row">
      <div class="col d-flex">
        <h5 class="flex-grow-1"><i class="fas fa-graduation-cap"></i>&ensp;Licensures</h5>
        <button class="btn -lime-outline -circle" data-toggle="modal" data-target="#licensureModal">
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
    <hr class="cstm-hr mb-0">
  </div>
  @forelse($user->licensures as $licensure)
  <div class="clean-container px-2">
   <h5 class="clean-container-title">{{ $licensure->name }}&nbsp;
    <small class="text-muted">{{ $licensure->type }}</small>
  </h5>
  <p class="clean-container-sub-title">{{ $licensure->number }}</p>
</div>
@empty
<div class="mt-4">
 <p>No data to show</p>
</div>
@endforelse
</section>
@endif
<!-- / Licensures -->
<!-- Trainings -->
@if (!$user->isClient())
<section class="profile-section" id="trainingsSection">
  <div class="section__head">
    <div class="row">
      <div class="col d-flex">
        <h5 class="flex-grow-1"><i class="fas fa-tools"></i>&ensp;Trainings</h5>
        <button class="btn -lime-outline -circle" data-toggle="modal" data-target="#trainingModal">
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
    <hr class="cstm-hr mb-0">
  </div>
  @forelse($user->trainings as $training)
  <div class="clean-container">
   <h5 class="clean-container-title mb-3">{{ $training->title.' | '.$training->company }}</h5>
   <span class="clean-container-text d-block -bold m-0">Certificate Number:</span>
   {{ $training->cert_number }}
   <p class="clean-container-year">{{ $training->started_at->format('Y M') }} - {{ $training->ended_at->format('Y M') }}</p>
 </div>
 @empty
 <div class="mt-4">
   <p>No data to show</p>
 </div>
 @endforelse
</section>
@endif
<!-- / Training -->
<!-- Affiliations -->
@if (!$user->isClient())
<section class="profile-section" id="affiliationsSection">
  <div class="section__head">
    <div class="row">
      <div class="col d-flex">
        <h5 class="flex-grow-1"><i class="fas fa-graduation-cap"></i>&ensp;Affiliations</h5>
        <button class="btn -lime-outline -circle" data-toggle="modal" data-target="#affiliationModal">
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
    <hr class="cstm-hr mb-0">
  </div>
  @forelse($user->affiliations as $affiliation)
  <div class="clean-container px-2">
   <h5 class="clean-container-title">{{ $affiliation->organization_name }} | {{ ($affiliation->position) ? $affiliation->position : 'None' }}</h5>
   <p class="clean-container-sub-title">{{ $affiliation->school }}</p>
   <p class="clean-container-year">
    {{ $affiliation->started_at->format('Y').' - '.$affiliation->ended_at->format('Y') }}
  </p>
</div>
@empty
<div class="mt-4">
 <p>No data to show</p>
</div>
@endforelse
</section>
@endif
<!-- / Affiliations -->
<!-- See more -->
@if (!$user->isClient())
<div class="profile-see-more mb-5">
  <p class="profile-see-more__text text-center pointer" id="seeMore" onclick="seeMore()"><i class="fas fa-chevron-down"></i>&ensp;see more...</p>
  <p class="profile-see-more__text text-center pointer" id="showLess" onclick="showLess()"><i class="fas fa-chevron-up"></i>&ensp;show less...</p>
</div>
@endif
<!-- / See more -->
</div>
<div class="col-md-3 profile-right">
  <a href="#" class="btn -bleached btn-block text-uppercase fw-bold" data-toggle="modal" data-target="#contactModal"><i class="far fa-paper-plane"></i>&ensp;Contact me</a>
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
    {{-- / Profile link --}}
    <hr>

    @if (!$user->isClient())
    {{-- Relocation --}}
    <div class="my-4 px-3"> 
      <h4 class="fw-bold mb-4">Relocation</h4>
      <div class="icheck-material-lightgreen">
        <input type="checkbox" id="relocate" name="relocate" value="1" {{ $user->preference !== null && $user->preference->relocation === 1 ? 'checked' : null }} disabled>
        <label class="fw-bold" for="relocate">I am willing to relocate</label>
      </div>
    </div>
    {{-- / Relocation --}}
    <hr>
    {{-- Desired job types --}}
    <div class="my-4 px-3"> 
      <h4 class="fw-bold mb-4">Desired Professional Services</h4>
      <ul>
        <li class="mb-3">
          <div class="icheck-material-lightgreen">
            <input type="checkbox" id="full_time" name="full_time" value="1" {{ $user->preference !== null && $user->preference->full_time === 1 ? 'checked' : null }} disabled>
            <label class="fw-bold" for="full_time">Full-time</label>
          </div>
        </li>
        <li class="mb-3">
          <div class="icheck-material-lightgreen">
            <input type="checkbox" id="part_time" name="part_time" value="1" {{ $user->preference !== null && $user->preference->part_time === 1 ? 'checked' : null }} disabled>
            <label class="fw-bold" for="part_time">Part-time</label>
          </div>
        </li>
        <li class="mb-3">
          <div class="icheck-material-lightgreen">
            <input type="checkbox" id="temporary" name="temporary" value="1" {{ $user->preference !== null && $user->preference->temporary === 1 ? 'checked' : null }} disabled>
            <label class="fw-bold" for="temporary">Temporary</label>
          </div>
        </li>
        <li class="mb-3">
          <div class="icheck-material-lightgreen">
            <input type="checkbox" id="contract" name="contract" value="1" {{ $user->preference !== null && $user->preference->contract === 1 ? 'checked' : null }} disabled>
            <label class="fw-bold" for="contract">Contract</label>
          </div>
        </li>
        <li class="mb-3">
          <div class="icheck-material-lightgreen">
            <input type="checkbox" id="internship" name="internship" value="1" {{ $user->preference !== null && $user->preference->internship === 1 ? 'checked' : null }} disabled>
            <label class="fw-bold" for="internship">Internship</label>
          </div>
        </li>
        <li class="mb-3">
          <div class="icheck-material-lightgreen">
            <input type="checkbox" id="commission" name="commission" value="1" {{ $user->preference !== null && $user->preference->commission === 1 ? 'checked' : null }} disabled>
            <label class="fw-bold" for="commission">Commission</label>
          </div>
        </li>
        <li class="mb-3">
          <div class="icheck-material-lightgreen">
            <input type="checkbox" id="new_grad" name="new_grad" value="1" {{ $user->preference !== null && $user->preference->new_grad === 1 ? 'checked' : null }} disabled>
            <label class="fw-bold" for="new_grad">New-Grad</label>
          </div>
        </li>
      </ul>
    </div>
    {{-- / Desired job types --}}
    @endif
  </div>
</div>
</div>
</div>
@endsection

@section('modal')
<profile-modals
:account = "{{ json_encode($user) }}"
:account_classifications = "{{ json_encode($user_classifications->pluck('classification')) }}"
:account_preference	 = "{{ json_encode($user_preference) }}"
:classification_list	 = "{{ json_encode($classification_list) }}"
></profile-modals>
{{-- Address --}}
<div class="modal fade" id="addressModal" role="dialog" aria-labelledby="addressModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addressModalTitle">Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/settings/address" id="addressForm">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label class="fw-bold">Region</label>
            <select class="form-control select2-region" name="region_id">
              @if ($user->region !== null)
              <option value="{{ $user->region->id }}">{{ $user->region->code.' - '.$user->region->name }}</option>
              @else
              <option></option>
              @endif
              @foreach ($regions as $region)
              <option value="{{ $region->id }}">{{ $region->code.' - '.$region->name }}</option>
              @endforeach
            </select>
            @error('region_id') @alert() {{ $message }} @endalert @enderror       
          </div>

          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label class="fw-bold">City / Municipality</label>
                <select class="form-control select2-city" name="city_id">
                  @if ($user->city !== null)
                  <option value="{{ $user->city->id }}">{{ $user->city->name }}</option>
                  @else
                  <option></option>
                  @endif
                  @foreach ($cities as $city)
                  <option value="{{ $city->id }}">{{ $city->name }}</option>
                  @endforeach
                </select>
                @error('city_id') @alert() {{ $message }} @endalert @enderror       
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label class="fw-bold">Zip code</label>
                <input
                class="form-control @error('zip') is-invalid @enderror"
                type="number"
                name="zip"
                value="{{ $user->zip }}">
                @error('zip') @alert() {{ $message }} @endalert @enderror
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn -back" type="button" data-dismiss="modal">Close</button>
        <button class="btn -submit" type="submit" onclick="document.getElementById('addressForm').submit()">Save</button>
      </div>
    </div>
  </div>
</div>
{{-- Address --}}
{{-- Specialties Modal --}}
<div class="modal fade" id="specialtiesModal" tabindex="-1" role="dialog" aria-labelledby="specialtiesModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="specialtiesModalTitle">Specialties</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/classifications" id="specialtiesForm">
          @csrf

          @if ($user->isProfessional())
          <input type="hidden" name="entity_type" value="1">
          @elseif($user->isCompany())
          <input type="hidden" name="entity_type" value="2">
          @elseif($user->isClient())
          <input type="hidden" name="entity_type" value="3">
          @endif

          <input type="hidden" name="entity_id" value="{{ session('user_id') }}">

          <div>
            <label class="typo__label">Enter your Classifications</label>
            <classifications>
            </classification>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn -back" data-dismiss="modal">Close</button>
        <button type="button" class="btn -submit" onclick="specialtiesSubmit()">Save</button>
      </div>
    </div>
  </div>
</div>
{{-- /Specialties Modal --}}
<!-- Primary Classification -->
<div class="modal fade" id="professionModal" tabindex="-1" role="dialog" aria-labelledby="professionModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="professionModalTitle">Profession</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/primary-classification" id="professionForm">
          @csrf

          @if ($user->isProfessional())
          <input type="hidden" name="entity_type" value="1">
          @elseif($user->isCompany())
          <input type="hidden" name="entity_type" value="2">
          @elseif($user->isClient())
          <input type="hidden" name="entity_type" value="3">
          @endif

          <input type="hidden" name="entity_id" value="{{ session('user_id') }}">
          
          <div class="form-group">
            <select class="form-control select2-primary-classification" name="classification_id">
              <option></option>
              @foreach ($classification_list as $classification)
              <option value="{{ $classification->id }}">{{ $classification->name }}</option>
              @endforeach
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn -back" data-dismiss="modal">Close</button>
        <button type="button" class="btn -submit" onclick="document.getElementById('professionForm').submit()">Save</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- / Primary Classification -->
<!-- Overview -->
<div class="modal fade" id="overviewModal" tabindex="-1" role="dialog" aria-labelledby="overviewModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="overviewModalTitle">Overview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/summary" id="summaryForm">
          @csrf

          @if ($user->preference !== null)
          <textarea class="form-control ckeditor-container" name="summary" id="summary">{{ $user->preference->summary }}</textarea>
          @error('summary') @alert() {{ $message }} @endalert @enderror
          @else
          <textarea class="form-control ckeditor-container" name="summary" id="summary"></textarea>
          @endif
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn -back" type="button" data-dismiss="modal">Close</button>
        <button class="btn -submit" type="submit" onclick="document.getElementById('summaryForm').submit()">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- / Overview -->
{{-- Experience --}}
<div class="modal fade" id="experienceModal" tabindex="-1" role="dialog" aria-labelledby="experienceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fw-bold" id="experienceModalLabel">Add Experience</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/settings/experiences" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="fw-bold">Job title</label>
            <input
            class="form-control @error('job_title') is-invalid @enderror"
            type="text"
            name="job_title"
            value="{{ old('job_title') }}">
            @error('job_title') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-group">
            <label class="fw-bold">Company</label>
            <input
            class="form-control @error('company') is-invalid @enderror"
            type="text"
            name="company"
            value="{{ old('company') }}">
            @error('company') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-row form-group">
            <div class="col">
              <label class="fw-bold">Time period</label>
              <input class="form-control @error('started_at') is-invalid @enderror" type="date" name="started_at" value="{{ old('started_at') }}">
              @error('started_at') @alert() {{ $message }} @endalert @enderror
            </div>
            <div class="col">
              <label class="fw-bold">&ensp;</label>
              <input class="form-control @error('ended_at') is-invalid @enderror" type="date" name="ended_at" value="{{ old('ended_at') }}">
              @error('ended_at') @alert() {{ $message }} @endalert @enderror
            </div>
          </div>

          <div class="form-group">
            <label class="fw-bold">Responsibilities&ensp;(Optional)</label> 
            <textarea class="form-control" name="responsibilities" id="responsibilities">{{ old('responsibilities') }}</textarea>
            @error('responsibilities') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-group">
            <label class="fw-bold">Accomplishments&ensp;(Optional)</label>
            <textarea class="form-control" name="accomplishments" id="accomplishments">{{ old('accomplishments') }}</textarea>
            @error('accomplishments') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-group">
            <label class="fw-bold">Skills used&ensp;(Optional)</label>
            <textarea class="form-control" name="skills" id="skills">{{ old('skills') }}</textarea>
            @error('skills') @alert() {{ $message }} @endalert @enderror
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn -back" type="button" data-dismiss="modal">Close</button>
          <button class="btn -submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- / Experience --}}
{{-- Education --}}
<div class="modal fade" id="educationModal" tabindex="-1" role="dialog" aria-labelledby="educationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="educationModalLabel">Add education</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/settings/educations" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="fw-bold">Degree</label>
            <input
            class="form-control @error('degree') is-invalid @enderror"
            type="text"
            name="degree"
            value="{{ old('degree') }}">
            @error('degree') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-group">
            <label class="fw-bold">Field of Study</label>
            <input
            class="form-control @error('field') is-invalid @enderror"
            type="text"
            name="field"
            value="{{ old('field') }}">
            @error('field') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-group">
            <label class="fw-bold">School</label>
            <input
            class="form-control @error('school') is-invalid @enderror"
            type="text"
            name="school"
            value="{{ old('school') }}">
            @error('school') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-row">
            <div class="col">
              <label class="fw-bold">Time period</label>
              <input class="form-control @error('started_at') is-invalid @enderror" type="date" name="started_at" value="{{ old('started_at') }}">
              @error('started_at') @alert() {{ $message }} @endalert @enderror
            </div>
            <div class="col">
              <label class="fw-bold">&ensp;</label>
              <input class="form-control @error('ended_at') is-invalid @enderror" type="date" name="ended_at" value="{{ old('ended_at') }}">
              @error('ended_at') @alert() {{ $message }} @endalert @enderror
            </div>
          </div>

          {{-- <div class="form-row">
            <div class="col">
              @include('components.datepicker', [
                'label' => 'Time period',
                'name'  => 'started_at'
              ])
            </div>
            <div class="col">
              @include('components.datepicker', [
                'name'  => 'ended_at'
              ])
            </div>
          </div> --}}
        </div>
        <div class="modal-footer">
          <button class="btn -back" type="button" data-dismiss="modal">Close</button>
          <button class="btn -submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- / Education --}}
{{-- Licensure --}}
<div class="modal fade" id="licensureModal" tabindex="-1" role="dialog" aria-labelledby="licensureModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="licensureModalLabel">Add licensure</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/settings/licensures" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="fw-bold">Type</label>
            <select class="form-control" name="type">
              <option value="licensure">Licensure</option>
              <option value="certificate">Certificate</option>
            </select>
            @error('type') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-group">
            <label class="fw-bold">Name</label>
            <input
            class="form-control @error('name') is-invalid @enderror"
            type="text"
            name="name"
            value="{{ old('name') }}">
            @error('name') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-group">
            <label class="fw-bold">Number</label>
            <input
            class="form-control @error('number') is-invalid @enderror"
            type="text"
            name="number"
            value="{{ old('number') }}">
            @error('number') @alert() {{ $message }} @endalert @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn -back" type="button" data-dismiss="modal">Close</button>
          <button class="btn -submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- / Licensure --}}
{{-- Training --}}
<div class="modal fade" id="trainingModal" tabindex="-1" role="dialog" aria-labelledby="trainingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="trainingModalLabel">Add training</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/settings/trainings" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="fw-bold">Title</label>
            <input
            class="form-control @error('title') is-invalid @enderror"
            type="text"
            name="title"
            value="{{ old('title') }}">
            @error('title') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-group">
            <label class="fw-bold">Company</label>
            <input
            class="form-control @error('company') is-invalid @enderror"
            type="text"
            name="company"
            value="{{ old('company') }}">
            @error('company') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-row mb-3">
            <div class="col">
              <label class="fw-bold">Time period</label>
              <input class="form-control @error('started_at') is-invalid @enderror" type="date" name="started_at" value="{{ old('started_at') }}">
              @error('started_at') @alert() {{ $message }} @endalert @enderror
            </div>
            <div class="col">
              <label class="fw-bold">&ensp;</label>
              <input class="form-control @error('ended_at') is-invalid @enderror" type="date" name="ended_at" value="{{ old('ended_at') }}">
              @error('ended_at') @alert() {{ $message }} @endalert @enderror
            </div>
          </div>

          <div class="form-group">
            <label class="fw-bold">Certificate Number</label>
            <input
            class="form-control @error('cert_number') is-invalid @enderror"
            type="text"
            name="cert_number"
            value="{{ old('cert_number') }}">
            @error('cert_number') @alert() {{ $message }} @endalert @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn -back" type="button" data-dismiss="modal">Close</button>
          <button class="btn -submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- / Training --}}
{{-- Affiliation --}}
<div class="modal fade" id="affiliationModal" tabindex="-1" role="dialog" aria-labelledby="affiliationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="affiliationModalLabel">Add affiliation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/settings/affiliations" method="post">
        @csrf
        <div class="modal-body">

          <div class="form-group">
            <label class="fw-bold">Status</label>
            <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
            @error('status') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-group">
            <label class="fw-bold">Organization Name</label>
            <input
            class="form-control @error('organization_name') is-invalid @enderror"
            type="text"
            name="organization_name"
            value="{{ old('organization_name') }}">
            @error('organization_name') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-group">
            <label class="fw-bold">Position</label>
            <input
            class="form-control @error('position') is-invalid @enderror"
            type="text"
            name="position"
            value="{{ old('position') }}">
            @error('position') @alert() {{ $message }} @endalert @enderror
          </div>

          <div class="form-row">
            <div class="col">
              <label class="fw-bold">Time period</label>
              <input class="form-control @error('started_at') is-invalid @enderror" type="date" name="started_at" value="{{ old('started_at') }}">
              @error('started_at') @alert() {{ $message }} @endalert @enderror
            </div>
            <div class="col">
              <label class="fw-bold">&ensp;</label>
              <input class="form-control @error('ended_at') is-invalid @enderror" type="date" name="ended_at" value="{{ old('ended_at') }}">
              @error('ended_at') @alert() {{ $message }} @endalert @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn -back" type="button" data-dismiss="modal">Close</button>
          <button class="btn -submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- / Affiliation --}}
@endsection

@push('scripts')
<script src="{{ asset('js/lodash.js') }}"></script>
<script>

  CKEDITOR.replace('summary');
  CKEDITOR.replace('responsibilities');
  CKEDITOR.replace('accomplishments');
  CKEDITOR.replace('skills');

  $(".select2-city").select2({
    placeholder: "City / Municipality",
    width: '100%',
  });

  $(".select2-region").select2({
    placeholder: "Region",
    width: '100%',
  });

  $('document').ready( function() {
    document.getElementById('worksSection').style.display = 'none';
    document.getElementById('educationsSection').style.display = 'none';
    document.getElementById('licensuresSection').style.display = 'none';
    document.getElementById('trainingsSection').style.display = 'none';
    document.getElementById('affiliationsSection').style.display = 'none';
    document.getElementById('showLess').style.display = 'none';

    $(".select2-primary-classification").select2({
      width: 'auto',
      dropdownAutoWidth: true,
      placeholder: "Select your classification",
      allowClear: true
    });
  });

  function seeMore(){
    document.getElementById('worksSection').style.display = 'block';
    document.getElementById('educationsSection').style.display = 'block';
    document.getElementById('licensuresSection').style.display = 'block';
    document.getElementById('trainingsSection').style.display = 'block';
    document.getElementById('affiliationsSection').style.display = 'block';

    document.getElementById('seeMore').style.display = 'none';
    document.getElementById('showLess').style.display = 'block';
  }

  function showLess(){
    document.getElementById('worksSection').style.display = 'none';
    document.getElementById('educationsSection').style.display = 'none';
    document.getElementById('licensuresSection').style.display = 'none';
    document.getElementById('trainingsSection').style.display = 'none';
    document.getElementById('affiliationsSection').style.display = 'none';

    document.getElementById('seeMore').style.display = 'block';
    document.getElementById('showLess').style.display = 'none';
  }

  function showProfileImageButton(){
    $('#profile-image__btn-container').css('display', 'flex');
  }

  function hideProfileImageButton(){
    $('#profile-image__btn-container').css('display', 'none');
  }

  function projectHover(key) {
    document.getElementById('project-options' + key).style.display = 'flex';
  }

  function projectRemoveHover(key) {
    document.getElementById('project-options' + key).style.display = 'none';
  }

  function addProjectHover() {
    document.getElementById('project-add').style.display = 'block';
  }

  function copyProfileLink(){
    var copyText = document.getElementById("profileLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
  }

  function specialtiesSubmit(){
    document.getElementById('specialtiesForm').submit();
  }
</script>
@endpush