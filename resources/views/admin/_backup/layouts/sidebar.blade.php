<div class="a-sidebar">
	{{-- <div class="container-img-border" style="position: relative; z-index: 2; width: 94%; margin-top: -4rem; background-color: #322E2F; height: 100px; width: 100px;">
		<img class="img-responsive rounded-circle" src="/storage/images/profile-images/default.png" alt="avatar">
	</div> --}}

	<ul style="width: 94%">
		<li class="a-sidebar__list {{ Request::is('admin/dashboard') ? '-active' : '' }}">
			<a href="/admin/dashboard">
				<i class="fas fa-tachometer-alt"></i>
				<span class="ml-2">Dashboard</span>
				@if (Request::is('admin/dashboard'))
					<div class="a-sidebar__list-arrow"></div>
				@endif
			</a>
		</li>

		<li class="a-sidebar__list {{ Request::is('admin/projects/featured-projects') ? '-active' : '' }}">
			<a data-toggle="collapse" href="#collapseProjects" role="button" aria-expanded="{{ Request::is('admin/projects/featured-projects') ? 'true' : 'false' }}" aria-controls="collapseProjects">
				<span><i class="far fa-building"></i></span>
				<span class="ml-2">Projects</span>
				<span class="a-sidebar__list-item-caret"><i class="fas fa-caret-down"></i></span>
			</a>
			<ul class="collapse {{ Request::is('admin/projects/featured-projects') ? 'show' : '' }}" id="collapseProjects">
				<li class="a-sidebar__list-item">
					<a href="/admin/projects/featured-projects">
						<span>Featured Projects</span>
						@if (Request::is('admin/projects/featured-projects'))
							<div class="a-sidebar__list-arrow"></div>
						@endif
					</a>
				</li>
				<li class="a-sidebar__list-item"><a href="/admin/projects/featured-projects">Sample Link 1</a></li>
				<li class="a-sidebar__list-item"><a href="/admin/projects/featured-projects">Sample Link 2</a></li>
			</ul>
		</li>

		<li class="a-sidebar__list">
			<a data-toggle="collapse" href="#collapseSettings" role="button" aria-expanded="false" aria-controls="collapseSettings">
				<span><i class="fas fa-check"></i></span>
				<span class="ml-2">Link with refs</span>
				<span class="a-sidebar__list-item-caret"><i class="fas fa-caret-down"></i></span>
			</a>
			<ul class="collapse" id="collapseSettings">
				<li class="a-sidebar__list-item"><a href="/admin/projects/featured-projects">Another Link 1</a></li>
				<li class="a-sidebar__list-item"><a href="/admin/projects/featured-projects">Another Link 2</a></li>
				<li class="a-sidebar__list-item"><a href="/admin/projects/featured-projects">Another Link 3</a></li>
			</ul>
		</li>
	</ul>

	<div class="a-sidebar__footer">
		<a href="/logout" onclick="event.preventDefault();document.getElementById('logout').submit()" title="Logout">
			<i class="fas fa-power-off"></i>
		</a>

		<form id="logout" action="/logout" method="POST" style="display: none;">
			@csrf
		</form>
	</div>
</div>