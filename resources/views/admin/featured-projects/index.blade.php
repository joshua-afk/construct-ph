@extends('admin.layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('/vendor/startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('css/custom-btn.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Feature Projects</h1>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Name</th>
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
								<button class="btn btn-sm -lime" type="submit"><i class="fas fa-check"></i>&ensp;Featured</button>
							</form>
							@else
							<form action="/admin/projects/{{ $project->id }}/feature" method="POST">
								@csrf
								@method('PUT')
								<button class="btn btn-sm -lime-outline" type="submit"><i class="fas fa-check"></i>&ensp;Feature</button>
							</form>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('/vendor/startbootstrap-sb-admin-2-gh-pages/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/vendor/startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('/vendor/startbootstrap-sb-admin-2-gh-pages/js/demo/datatables-demo.js') }}"></script>
@endsection