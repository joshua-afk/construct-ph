@extends('admin.layouts.app')

@section('navbar')
<header>
	<h1 class="a-header">
		<span class="a-header__icon">
			<i class="fas fa-tachometer-alt"></i>
		</span>
		<span class="a-header__text pl-3 pr-2">Dashboard</span>
	</h1>

	<span class="ml-3">
		<a href="{{ Request::url() }}"><i class="fas fa-sync-alt -pointer" title="Refresh" style="color: #4285F4; font-size: 17px"></i></a>
	</span>
</header>
@endsection