@extends('admin.layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
@endsection

@section('navbar')
	@component('admin.components.navbar')
		@slot('logo')
			<i class="far fa-building"></i>
		@endslot

		@slot('index')
			Projects
		@endslot

		Featured
	@endcomponent
@endsection

@section('content')
<div class="a-panel p-4 mb-0">
	<table id="example" class="table table-striped table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>Name</th>
			{{-- <th>Description</th> --}}
			{{-- <th>Image</th> --}}
			<th>Featured</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Status</th>
			<th>&ensp;</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($projects as $project)
		<tr>
			<td>{{ $project->name }}</td>
			<td>
				@if ($project->is_featured == 1)
					<span class="badge badge-pill badge-success">
						Yes
					</span>
				@else
					<span class="badge badge-pill badge-danger">
						No
					</span>
				@endif
			</td>
			<td>{{ \Carbon\Carbon::parse($project->date_start)->format('D, M d, Y') }}</td>
			<td>{{ \Carbon\Carbon::parse($project->date_finish)->format('D, M d, Y') }}</td>
			<td>
				@if ($project->status == 1)
					<span class="badge badge-pill badge-success">
						Shown
					</span>
				@else
					<span class="badge badge-pill badge-danger">
						Hidden
					</span>
				@endif
			</td>
			<td>
				@if ($project->is_featured == 1)
					<form action="/admin/projects/{{ $project->id }}/unfeature" method="POST">
						@csrf
						@method('PUT')
						<button class="btn btn-sm -red" type="submit"><i class="fas fa-times"></i>&ensp;Unfeature</button>
					</form>
				@else
					<form action="/admin/projects/{{ $project->id }}/feature" method="POST">
						@csrf
						@method('PUT')
						<button class="btn btn-sm -lime" type="submit"><i class="fas fa-check"></i>&ensp;Feature</button>
					</form>
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#example').DataTable();
	});
</script>
@endsection