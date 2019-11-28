@extends('layouts.app')

@section('styles')
<style>
	.form-container{
		width: 60rem;
	}
</style>
@endsection

@section('content')
<add-project-image :project="{{ json_encode($project) }}"></add-project-image>
@endsection