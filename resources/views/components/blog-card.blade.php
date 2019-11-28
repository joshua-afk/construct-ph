<div class="company-blog__container">
	<div class="blog-card">
		<div>
			<div>
				<span class="fw-500">Blog</span> &#8231;
				<span class="text-muted">{{ $date }}</span>
			</div>
			<div class="my-2">
				<h2>{{ $title }}</h2>
			</div>
		</div>
		<div class="blog-card__profile">
			{{-- Left (Profile) --}}
			<div>
				<div class="container--img-border overflow-hidden rounded-circle" style="height: 70px; width: 70px">
					<img src="/storage/images/profile-images/{{ $image ?? 'default.png' }}" class="img--responsive" alt="{{ $image }}">
				</div>
			</div>
			{{-- Right (Author, Comments) --}}
			<div>
				<div class="d-flex align-items-center">
					<div class="ml-4">
						<span class="text-muted">Author</span><br>
						<a class="fw-bold" href="/profile/{{ $username }}">{{ $first_name.' '.$last_name }}</a>
						<br>
					</div>
					<div class="ml-4">
						<span class="text-muted">Comments (4)</span><br>
						<a class="fw-bold" href="/profile/{{ $username }}">Go to comments</a>
						<br>
					</div>
				</div>
			</div>
		</div>
		<div class="blog-card__body">
			<div class="blog-card__body-text">{{ $content }}</div>
		</div>
		<div class="mt-4">
			<span class="badge badge-pill badge-light -hvr_green">No classification</span>&ensp;
		</div>
	</div>
</div>

{{-- @include('components.blog-card', [
	'date' 	     => 'November 9, 2019',
	'title'      => 'My Blog Title',
	'image' 	 => '',
	'username'   => 'com.pany',
	'first_name' => 'Com',
	'last_name'  => 'Pany',
	'content'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum animi autem maiores numquam mollitia veritatis nemo facere porro, quos assumenda, beatae natus veniam a tempora, modi harum soluta enim qui.'
]) --}}