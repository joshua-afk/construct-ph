<?php

namespace App\Http\Controllers;

use App\User;

class ProfileController extends Controller
{
	public function index()
	{
		return redirect('/profile/' . session('user_username'));
	}

	public function show($username)
	{
		$user = User::where('username', $username)->firstOrFail();
		// return $user = User::where('username', $username)->firstOrFail()->companies;

		if (session()->hasNo('user_id')) {
			return redirect('/login')->with(['login' => 'Please login to continue.']);
		}

        // NOTE: Check if this is needed
		$user_preference      = $user->preference;
		$user_classifications = $user->other_classifications;
		$user_projects        = $user->projects;
		$classification_list  = $this->classifications();
		$ratings_average      = (count($user->reviews) !== 0) ?
								(array_sum($user->reviews->pluck('rate')->toArray()) / count($user->reviews)) :
								0 ;

		$regions = $this->regions();
		$cities = $this->cities();

		return view('profile', compact('user', 'reviews', 'user_preference', 'user_classifications', 'user_projects', 'classification_list', 'ratings_average', 'regions', 'cities'));
	}
}
