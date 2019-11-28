<navbar-dark
	:session	="{{ json_encode(session()->all()) }}"
	:account_id ="'{!! session('user_id') !!}'"
></navbar-dark>