<div class="company-blog__container">
	<div class="blog-card">
		<div>
			<div>
				<span class="fw-500">Job</span> &#8231;
				<span class="text-muted">{{ $date }}</span>
			</div>
			<div class="my-2 row align-items-center">
				<div class="col">
					<h2>{{ $job_title }}</h2>
				</div>
				{{-- Bookmark --}}
					<div class="mr-3">
						@if (in_array($id, $bookmarks))
						<button
							class="btn pl-0 pr-0 -circle -blue"
							onclick="unbookmark('{{ $code }}')">
						<i class="far fa-bookmark"></i>
						</button>
						@else
						<button
							class="btn pl-0 pr-0 -circle -blue-outline"
							onclick="bookmark('{{ $code }}')">
						<i class="far fa-bookmark"></i>
						</button>
						@endif
					</div>
					<form class="d-hidden" id="bookmark-form-{{ $code }}" action="/bookmarks" method="post">
						@csrf
						<input type="hidden" name="user_id" value="{{ session('user_id') }}">
						<input type="hidden" name="bookmark_type" value="Job">
						<input type="hidden" name="bookmark_id" value="{{ $id }}">
					</form>
					<form class="d-hidden" id="unbookmark-form-{{ $code }}" action="/bookmarks" method="post">
						@csrf
						@method('delete')
						<input type="hidden" name="user_id" value="{{ session('user_id') }}">
						<input type="hidden" name="bookmark_type" value="Job">
						<input type="hidden" name="bookmark_id" value="{{ $id }}">
					</form>
				{{-- / Bookmark --}}
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
						<span class="text-muted">Employer</span><br>
						<a class="fw-bold" href="/profile/{{ $username }}">{{ $name }}</a>
						<br>
					</div>
					<div class="ml-4">
						<span class="text-muted">Company</span><br>
						<span class="fw-bold">{{ $company ?? 'N/A' }}</span>
						<br>
					</div>
					<div class="ml-4">
						<span class="text-muted">Budget</span><br>
						<span class="fw-bold">&#8369;{{ $salary_min }} - &#8369;{{ $salary_max }}</span>
						<br>
					</div>
					<div class="ml-4">
						<span class="text-muted">Job Post</span><br>
						<a class="fw-bold" href="/jobs/{{ $code }}">Go to job post</a>
						<br>
					</div>
				</div>
			</div>
		</div>
		<div class="blog-card__body">
			<div class="blog-card__body-text ckeditor-container">{!! $content !!}</div>
		</div>
		<div class="mt-4">
			@if ($classifications != null)
				@foreach ($classifications as $classification)
					<span class="badge badge-pill badge-light -hvr_green">{{ $classification->classification->name }}</span>&ensp;
				@endforeach
			@else
				<span class="badge badge-pill badge-light -hvr_green">No classification</span>&ensp;
			@endif
		</div>
	</div>
</div>

{{-- @include('components.job-post-card', [
	'date' 	     => 'November 9, 2019',
	'title'      => 'My Blog Title',
	'image' 	 => '',
	'username'   => 'com.pany',
	'first_name' => 'Com',
	'last_name'  => 'Pany',
	'content'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum animi autem maiores numquam mollitia veritatis nemo facere porro, quos assumenda, beatae natus veniam a tempora, modi harum soluta enim qui.'
]) --}}