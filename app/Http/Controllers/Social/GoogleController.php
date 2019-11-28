<?php

namespace App\Http\Controllers\Social;

use App\Events\UserLoggedIn;
use App\Http\Controllers\Controller;
use App\User;
use App\UserSocial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Socialite;

class GoogleController extends Controller
{
	public function redirectToProvider(){
		return Socialite::driver('google')->redirect();
	}

	public function handleProviderCallback(){

		// Get google account
		$google_user = Socialite::driver('google')->stateless()->user();

		// Register UserSocial
		$social_account = UserSocial::where([
								['provider_user_id', $google_user->id],
								['provider', 'google']
						  ])->first();

		if ($social_account == null) {
			// Create Account
			$user = new User;
			$user->code        = $this->uuid();
			$user->username    = null;
			$user->email 	  = $google_user->email;
			$user->password 	  = null;
			$user->first_name  = $google_user->user['given_name'];
			$user->last_name   = $google_user->user['family_name'];
			$user->image 	  = null;
			$user->birthdate   = null;
			$user->mobile 	  = null;
			$user->status 	  = 'pending';
			$user->save();

			// Create SocialAccount and bind AccountID
			UserSocial::insert([
				'user_id' 		   => $user->id,
				'provider_user_id' => $google_user->id,
				'provider' 		   => 'google',
				'created_at' 	   => now('Asia/Manila'),
				'updated_at' 	   => now('Asia/Manila')
			]);

			return redirect('/user-role');
		}

		// Get the account credentials
		$user = $social_account->user;

		if (is_null($user->type)) {
			return redirect('/user-role')->with(['user_key' => $user->id, 'provider' => 'google']);
		}

		// Login the user
		event(new UserLoggedIn($user, request()->_token));

		return redirect('/jobs');
	}
}
