<div class="form-group">
	<label class="fw-bold">
		@if (isset($label))
			{{ $label }}
		@else
			&nbsp;
		@endif
	</label>
	<input class="form-control @error($name) is-invalid @enderror" type="text" name="{{ $name }}" value="{{ old($name) }}">
	@error($name)
		@alert
		{{ $message }}
		@endalert
	@enderror
</div>

@push('scripts')
<script>
	$(function() {
		$('input[name="{{ $name }}"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 1901,
			maxYear: parseInt(moment().format('YYYY'),10)
		});
	});
</script>
@endpush

{{-- 
@include('components.datepicker', [
	'label' => 'Date',
	'name'  => 'date'
])
--}}