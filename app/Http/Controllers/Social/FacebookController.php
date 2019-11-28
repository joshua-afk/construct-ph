<?php

namespace App\Http\Controllers\Social;

use App\User;
use App\UserSocial;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Socialite;

class FacebookController extends Controller
{
	public function __construct(User $user, UserSocial $social)
	{
		$this->user = $user;
		$this->social = $social;
	}

	public function redirectToProvider(){
		return Socialite::driver('facebook')->redirect();
	}

	public function handleProviderCallback()
	{
		$facebook_user = Socialite::driver('facebook')
								  ->fields(['id', 'first_name', 'last_name', 'email'])
								  ->user();

		$social_account = UserSocial::where([
							 ['provider_user_id', $facebook_user->id],
							 ['provider', 'facebook']
						 ])->first();

		$uuid = $this->uuid();

		if ($social_account == null) {
			// Create Account
			$this->user->create([
				'code'          => $uuid,
				'username'      => null,
				'email' 	    => $facebook_user->email,
				'password' 	    => null,
				'first_name'    => $facebook_user->user['first_name'],
				'last_name'     => $facebook_user->user['last_name'],
				'image' 	    => null,
				'birthdate'     => null,
				'mobile_number' => null,
				'status' 	    => 'pending',
				'created_at'    => now('Asia/Manila'),
				'updated_at'    => now('Asia/Manila'),
			]);

			$user = User::where('code', $uuid)->first();

			// Create SocialAccount and bind AccountID
			$this->social->create([
				'user_id' 		      => $user->id,
				'provider_user_id' 	  => $facebook_user->id,
				'provider' 			  => 'facebook',
				'created_at' 		  => now('Asia/Manila'),
				'updated_at' 		  => now('Asia/Manila')
			]);

			return redirect('/user-role')->with(['user_key' => $user->id]);
		}

		// Get the account credentials
		$user = $social_account->user;

		if (is_null($user->type)) {
			return redirect('/user-role')->with(['user_key' => $user->id, 'provider' => 'facebook']);
		}

		// Login the user
		event(new UserLoggedIn($user, request()->_token));

		return redirect('/jobs');
	}
}
