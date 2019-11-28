@extends('layouts.app')

@section('styles')
<style>
	.fa-plus-circle{
		font-size: 1.1rem;
		color: inherit;
	}

	.project-image-container{
		position: relative;
		height: 200px;
	}

	.project-image-container img{
		object-fit: cover;
		width: 100%;
		height: 200px;
	}

	.project-images-container{
		position: relative;
		height: 200px;
		width: 100%;
	}

	.images-container{
		position: relative;
		height: 200px;
		width: 100%;
	}

	.images-container img{
		object-fit: cover; 
		width: 100%;
		height: 200px;
	}

	.dz-details{
		background-color: rgba(167, 203, 0,.8);
	}

	.project-container{
		position: relative;
		height: 200px;
		background-color: #ccc;
		transition: all 0.15s ease 0s;
	}

	.project-images__options{
		position: absolute;
		z-index: 2;
		bottom: 0;
		height: 20%;
		width: 100%;
		background-color: rgba(119, 119, 119, 0.7);
		display: none;
		justify-content: center;
		align-items: center;
	}

	.project-images__options .fa-edit, 
	.project-images__options .fa-trash-alt,
	.project-images__options .fa-eye{
		font-size: 1.5rem
	}

	.fa-pen{
		color: #a7cb00;
	}
</style>
@endsection

@section('content')
<show-project
	:session="{{ json_encode(session()->all()) }}"
	:project="{{ json_encode($project) }}"
	:project_blog="{{ json_encode($project_blog) }}"
></show-project>
@endsection

@section('modal')
<show-project-modals
	:session="{{ json_encode(session()->all()) }}"
	:project="{{ json_encode($project) }}"
></show-project-modals>
@endsection

@section('scripts')
<script>
	CKEDITOR.replace('comment');
</script>
@endsection