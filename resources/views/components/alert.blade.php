<div class="alert alert-dismissible fade show {{ $class }}" role="alert" style="{{ $style ?? null }}">
	<span>{!! $slot !!}</span>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

{{-- 
@include('components.alert', [
	'class' => 'alert-success mb-3',
	'style' => 'margin: 0 auto; width: 30rem;',
	'slot'  => '<strong>Success!</strong> Account successfully created.'
]) 
--}}