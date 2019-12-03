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

  .job-post-description > p,
  .job-post-description > ul,
  .job-post-description > li {
    color: #6c757d;
    line-height: 1.6;
  }
</style>
@endsection

@if($user->isProfessional())
  @include('profile.professional')
@elseif($user->isCompany())
  @include('profile.company')
@elseif($user->isClient())
  @include('profile.client')
@endif

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
      width: '100%',
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