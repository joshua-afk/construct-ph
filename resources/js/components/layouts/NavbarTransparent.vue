<template>
	<nav class="navbar navbar-expand-lg -transparent">
		<div class="container">
			<a class="navbar-brand" href="/">
				<img class="navbar-brand__logo" src="storage/images/logo.png" alt="construct.ph logo">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item mr-2 active">
						<a class="nav-link -white fw-500" href="/">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item mr-2">
						<a class="nav-link -white fw-500" href="/about">About</a>
					</li>
					<li class="nav-item mr-4">
						<a class="nav-link -white fw-500" href="/email-us">Contact</a>
					</li>
					<!-- <li class="nav-item mr-4 dropdown">
						<a class="nav-link -white fw-500 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="/labour">Labour View</a>
							<a class="dropdown-item" href="/job-listing">Job Listing</a>
							<a class="dropdown-item" href="/profile">Profile</a>
							<a class="dropdown-item" href="/contact-us">Contact</a>
						</div>
					</li> -->
					<div class="my-2 my-lg-0 nav__btn">
						<a class="btn -lime mr-sm-2" href="/login">Login</a>
						<a class="btn -lime-outline my-2 my-sm-0 " href="/register">Register</a>
					</div>
				</ul>
			</div>
		</div>
	</nav>
</template>