@extends('layouts.app')

@section('content')
<div class="container pt-5 mb-5">
    <form action="/jobs" method="post">
        @csrf
        <div class="panel mx-auto w-75">
            <div class="panel__header">
                <h2 class="panel__title">Create a Job Post</h2>
                <div class="panel__header-line"></div>
            </div>
            <div class="panel__body w-75">
                @if (!$user->isCompany() && !$user->hasCompanies())
                <input type="hidden" name="entity_id" value="{{ session('user_id') }}">
                @else
                <div class="form-group">
                    <label class="fw-bold">Company Name</label>
                    <select name="entity_id" class="form-control select2-companies">
                        <option></option>
                        @foreach ($user->companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                    @error('entity_id') @alert() {{ $message }} @endalert @enderror
                    <small class="text-muted">If you don't have company, <a class="small-like" href="/companies/create">create here.</a></small>
                </div>
                @endif
                
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
                    <label class="fw-bold">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                    @error('description') @alert() {{ $message }} @endalert @enderror
                    <small class="text-muted">Information regarding the project.</small>
                </div>

                <div class="form-group">
                    <label class="fw-bold">Location</label>
                    <select class="form-control select2-region" name="region_id">
                        <option></option>
                        @foreach ($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->code.' - '.$region->name }}</option>
                        @endforeach
                    </select>
                    @error('region_id') @alert() {{ $message }} @endalert @enderror
                </div>

                <div class="form-group form-row">
                    <div class="col">
                        <select class="form-control select2-city" name="city_id">
                            <option></option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id') @alert() {{ $message }} @endalert @enderror
                    </div>
                    <div class="col">
                        <input
                            class="form-control @error('zip') is-invalid @enderror"
                            type="text"
                            name="zip"
                            value="{{ old('zip') }}">
                        @error('zip') @alert() {{ $message }} @endalert @enderror
                    </div>
                </div>

                <div class="form-group form-row">
                    <div class="col">
                        <label class="fw-bold">Salary</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">&#8369;</span>
                            </div>
                            <input
                                class="form-control @error('salary_min') is-invalid @enderror" 
                                type="text"
                                name="salary_min"
                                value="{{ old('salary_min') }}"
                                placeholder="min">
                        </div>
                        @error('salary_min') @alert() {{ $message }} @endalert @enderror
                    </div>
                    <div class="col">
                        <label>&ensp;</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">&#8369;</span>
                            </div>
                            <input
                                class="form-control @error('salary_max') is-invalid @enderror"
                                type="text"
                                name="salary_max"
                                value="{{ old('salary_max') }}"
                                placeholder="max">
                        </div>
                        @error('salary_max') @alert() {{ $message }} @endalert @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="fw-bold">Select Classifications</label>
                    <classifications></classifications>
                    @error('classifications') @alert() {{ $message }} @endalert @enderror
                    <small class="text-muted">Maximum of 10 classifications.</small>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label class="fw-bold">Deadline</label>
                        <input
                            class="form-control @error('deadline') is-invalid @enderror"
                            type="text"
                            name="deadline"
                            value="{{ old('deadline') }}">
                        @error('deadline') @alert() {{ $message }} @endalert @enderror
                    </div>
                    <div class="form-group col-md-7">
                        <label class="fw-bold">Number of positions</label>
                        <input 
                            class="form-control @error('hire_count') is-invalid @enderror"
                            type="text"
                            name="hire_count"
                            value="{{ old('hire_count') }}">
                        @error('hire_count') @alert() {{ $message }} @endalert @enderror
                        <small class="text-muted">How many employees would you like to hire.</small>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label class="fw-bold mb-2">Qualifications</label>

                    <div class="form-group">
                        <div class="icheck-material-lightgreen">
                            <input type="checkbox" id="professional" name="professional" value="1" {{ old('professional') ? 'checked' : null }}>
                            <label class="fw-bold" for="professional">Professional</label>
                        </div>

                        <div class="icheck-material-lightgreen">
                            <input type="checkbox" id="contractor" name="contractor" value="1" {{ old('contractor') ? 'checked' : null }}>
                            <label class="fw-bold" for="contractor">Contractor</label>
                        </div>

                        <div class="icheck-material-lightgreen">
                            <input type="checkbox" id="supplier" name="supplier" value="1" {{ old('supplier') ? 'checked' : null }}>
                            <label class="fw-bold" for="supplier">Supplier</label>
                        </div>
                    </div>
                    @error('professional') @alert() {{ $message }} @endalert @enderror
                </div>
    
                <hr class="cstm-hr">

                <div class="form-group">
                    <button class="btn -submit mr-2">Submit</button>
                    <a href="/jobs" class="btn -back">Go back</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $(".select2-companies").select2({
            placeholder: "Select a Company",
            allowClear: true
        });

        $(".select2-city").select2({
            placeholder: "City / Municipality"
        });

        $(".select2-region").select2({
            placeholder: "Region"
        });

        $(".select2-availability").select2({
            placeholder: "Select..."
        });
    });

    $(function() {
        $('input[name="deadline"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10) + 20
        });
    });

    CKEDITOR.replace('description');
</script>
@endpush