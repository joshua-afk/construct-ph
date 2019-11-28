@extends('admin.layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('/vendor/startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('css/custom-btn.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<h1 class="h3 mb-4 text-gray-800">Logs</h1>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>User ID</th>
						<th>Name</th>
						<th>Log Type</th>
						<th>Description</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($logs as $log)
					<tr>
						<td>{{ $log->user->id }}</td>
						<td>{{ $log->user->first_name.' '.$log->user->last_name }}</td>
						<td>{{ $log->type }}</td>
						<td>{{ $log->description }}</td>
						<td>{{ \Carbon\Carbon::parse($log->created_at)->format('M d, Y - h:i A') }}</td>
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