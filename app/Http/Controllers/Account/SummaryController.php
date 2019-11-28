<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\UserPreference;

class SummaryController extends Controller
{
	public function __construct(UserPreference $preference)
	{
		$this->preference = $preference;
	}

	public function store()
	{
		$validated_attr = request()->validate([
			'summary' => 'required',
		]);

		$this->preference->updateOrCreate([
			'user_id' => session('user_id')
		], $validated_attr);

		return back();
	}
}
