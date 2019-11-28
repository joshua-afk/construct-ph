<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ContactController extends Controller
{
	public function update()
	{
		$validated_attr = request()->validate([
			'mobile_number' => 'nullable|digits:11',
			'phone_number'  => 'nullable',
			'fax_number' 	=> 'nullable'
		]);

		$user = User::findOrFail(session('user_id'));
		$user->update($validated_attr + ['updated_at' => now('Asia/Manila')]);

		return back();
	}
}
