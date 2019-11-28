<button class="btn-w-icon {{ $class ?? '-lime' }}" {{ $attr ?? '' }}>
	<div class="btn-w-icon__logo">
		{!! $icon ?? '<i class="fas fa-check"></i>' !!}
	</div>
	<div class="btn-w-icon__triangle"></div>
	<div class="btn-w-icon__text">{{ $text }}</div>
</button>