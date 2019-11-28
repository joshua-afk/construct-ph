<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class PasswordController extends Controller
{
	public function update()
	{
		$validated_attr = request()->validate([
			'current_password' => 'required|min:6',
			'new_password'	   => 'required|min:6',
			'new_password_confirmation'	=> 'required|same:new_password',

		]);

		$user = User::findOrFail(session('user_id'));

		if (Hash::check(request()->current_password, $user->password)) {
			$user->update([
				'password'   => Hash::make(request()->new_password),
				'updated_at' => now('Asia/Manila')
			]);
		} else {
			return back()->with('failure', 'Your password is incorrect.');
		}

		return back()->with('success', 'Password changed.');
	}
}
