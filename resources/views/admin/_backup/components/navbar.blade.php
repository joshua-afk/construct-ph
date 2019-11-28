<header>
	<h1 class="a-header">
		<span class="a-header__icon">{{ $logo }}</span>
		<span class="a-header__text pl-3 pr-3">{{ $index }}</span>
		<span class="a-header__arrow"><i class="fas fa-caret-right"></i></span>
		<span class="a-header__text pl-3">{{ $slot }}</span>
	</h1>
	
	<span class="ml-3">
		<a href="{{ Request::url() }}"><i class="fas fa-sync-alt -pointer" title="Refresh" style="color: #4285F4; font-size: 17px"></i></a>
	</span>
</header>