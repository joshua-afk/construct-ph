<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
// use App\UserAddress;

class AddressController extends Controller
{
	public function update()
	{
		$validated_attr = request()->validate([
			'region_id' => 'required',
			'city_id'   => 'required',
			'zip' 		=> 'required'
		]);

		$user = User::findOrFail(session('user_id'));
		$user->update($validated_attr + ['updated_at' => now('Asia/Manila')]);

		return back();
	}
}
