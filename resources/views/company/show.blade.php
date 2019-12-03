@extends('layouts.app')

@section('content')
<section>
  <div class="container">
    <div class="company-cover__container">
      <img class="company-cover__image img-responsive" src="/storage/images/profile-images/8b245ac05697a6ad3e153dc9477fa51c_1573615206.jpg" alt="no-image">
    </div>
  </div>
</section>

<div class="container mb-5">
  <div class="row">
    {{-- Left Panel--}}
    <section class="col-4">
      <div class="company-info">
        {{-- Company Image --}}
        <div class="d-flex justify-content-center">
          <div class="company-info__image-wrapper">
            <img class="company-info__image img-responsive rounded-circle" src="/storage/images/profile-images/default.png">
          </div>
        </div>

        <div class="d-flex justify-content-center mt-2">
          <div>
            <h4 class="m-0 text-center">{{ $company->company_name }}</h4>
            <p class="d-flex justify-content-center">
              {{ !is_null($company->classification) ? $company->classification->classification : '---' }}
            </p>

            <div style="height: 4px; background-color: #A7CB00; width: 2rem; margin: 0 auto; margin-bottom: 1rem; border-radius: 10px"></div>

            {{-- Ratings --}}
            <div>
              <div class="text-center" style="color: #FFC000; font-size: 20px">
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
              <p class="text-center">
                <strong>{{ $ratings_average }}% Rating(s)</strong>&ensp;|&ensp;
                <span class="profile__left-right-reviews">{{ count($company->reviews) }} Review(s)</span>
              </p>
            </div>
            {{-- / Ratings --}}
          </div>
        </div>

        <hr>

        {{-- Company Attributes --}}
        <div class="company-attrib__container">
          <h4 class="text-muted fw-bold">Details</h4>
          <ul>
            {{-- PCAB --}}
            @if (!is_null($company->pcab_license))
            <li class="company-attrib__wrapper">
              <span class="mr-2"><i class="far fa-id-badge"></i></span>
              <span class="company-attrib">
                {{ $company->pcab_license }}
              </span>
            </li>
            @else
            <li class="company-attrib__wrapper">
              <span class="mr-2"><i class="fas fa-map-marker-alt"></i></span>
              <span class="company-attrib">
                No data to show.
              </span>
            </li>
            @endif
            {{-- Address --}}
            @if (!is_null($company->city) && !is_null($company->region))
            <li class="company-attrib__wrapper">
              <span class="mr-2"><i class="fas fa-map-marker-alt"></i></span>
              <span class="company-attrib">
                {{ $company->region->name }}, {{ $company->city->name }}
              </span>
            </li>
            @else
            <li class="company-attrib__wrapper">
              <span class="mr-2"><i class="fas fa-map-marker-alt"></i></span>
              <span class="company-attrib">
                No data to show.
              </span>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </section>
    {{-- / Left Panel --}}
    {{-- Right Panel --}}
    <section class="col-8">
      {{-- Overview --}}
      <div class="profile-section">
        <div class="section__head">
          <h5>
            <i class="far fa-user-circle"></i>&ensp;Overview
          </h5>
          <hr class="cstm-hr">
        </div>
        <div class="section__content">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>
      {{-- Overview --}}
      {{-- Jobs (Accepted) --}}
      <div class="profile-section">
        <div class="section__head">
          <h5>
            <i class="fas fa-tasks"></i>&ensp;Jobs (Accepted)
          </h5>
          <hr class="cstm-hr">
        </div>
        <div class="section__content">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>
      {{-- / Jobs (Accepted) --}}
      {{-- Jobs (Posted) --}}
      <div class="profile-section">
        <div class="section__head">
          <div class="d-flex">
            <h5 class="flex-grow-1"><i class="fas fa-tasks"></i>&ensp;Jobs (Posted)</h5>
            <div style="margin-top: -4px">
              <a class="btn -circle -lime-outline" href="/jobs/create">
                <i class="fas fa-plus"></i>
              </a>
            </div>
          </div>
          <hr class="cstm-hr">
        </div>
        <div class="section__content">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>
      {{-- / Jobs (Posted) --}}
      {{-- Projects --}}
      <div class="profile-section">
        <div class="section__head">
          <h5>
            <i class="far fa-building"></i>&ensp;Projects
          </h5>
          <hr class="cstm-hr">
        </div>
        <div class="section__content">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>
      {{-- / Projects --}}
      {{-- Projects --}}
      <div class="profile-section">
        <div class="section__head">
          <h5>
            <i class="far fa-building"></i>&ensp;Projects
          </h5>
          <hr class="cstm-hr">
        </div>
        <div class="section__content">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>
      {{-- / Projects --}}
    </section>
  </div>
</div>
@endsection

{{-- Carousel --}}
{{-- <div class="p-3">
  <section class="mb-3">
    <div class="company-project__container">
      <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <img class="card-img-top" src="/storage/images/no-image.jpg" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <img class="card-img-top" src="/storage/images/no-image.jpg" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <img src="/storage/images/no-image.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <img src="/storage/images/no-image.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <img src="/storage/images/no-image.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </section>
</div> --}}