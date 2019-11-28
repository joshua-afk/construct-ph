@extends('layouts.app')

@section('content')
<div class="container pt-5 mb-5">
	<div class="panel mx-auto w-75">
		<form method="post" action="/projects/{{ $project->code }}/blog">
			@csrf

			<div class="panel__header">
				<h2 class="panel__title">Create Blog</h2>
				<div class="panel__header-line"></div>
			</div>

			<div class="panel__body w-75">
				<div class="form-group">
					<label for="" class="fw-bold">Title</label>
					<input type="text" name="title" class="form-control">
				</div>

				<div class="form-group">
					<label for="" class="fw-bold">Content</label>
					<textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
				</div>

				<hr class="cstm-hr">

				<div class="form-group">
					<button type="submit" class="btn -submit mr-1">Publish</button>
					<a href="/projects/{{ $project->code }}" class="btn -back">Go back</a>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('scripts')
<script>
	CKEDITOR.replace('content');
</script>
@endsection