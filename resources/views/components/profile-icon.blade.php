<div class="row {{ $class ?? '' }}">
    <div class="col-1">
        <div class="container--img-border overflow-hidden rounded-circle" style="height: 50px; width: 50px">
            <img src="/storage/images/profile-images/{{ $profile_image ?? 'default.png' }}" class="img--responsive" alt="{{ $username }}">
        </div>
    </div>
    <div class="col-11 pl-2" style="display: flex; align-items: center;">
        <p>
            <a href="/profile/{{ $username }}">{{ $name }}</a> &#8231; <small class="text-muted">{{ \Carbon\Carbon::parse($created_at)->diffForHumans() }} at {{ \Carbon\Carbon::parse($created_at)->format('g:i A') }}</small>
            <br> <span>Company: </span> {{ $company ?? 'N/A' }}
        </p>
    </div>
</div>

{{-- USE --}}
{{-- @component('components.profile-icon')
    @slot('profile_image')
        
    @endslot
    @slot('username')
        
    @endslot
    @slot('name')
        
    @endslot
    @slot('created_at')
        
    @endslot
    @slot('company')
        
    @endslot
@endcomponent --}}