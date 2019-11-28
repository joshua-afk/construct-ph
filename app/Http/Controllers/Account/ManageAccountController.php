<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Region;
use App\City;

class ManageAccountController extends Controller
{
	public function __construct()
	{
		$this->middleware('accounts.only');
	}

	public function index()
	{
		$account = User::where('code', session('account_code'))
				   ->with('currentAddress')
				   ->firstOrFail();

		if ($account->currentAddress != null) {
			$regions = Region::where('id', '!=', $account->currentAddress->region->id)
					   ->orderBy('code')
					   ->get();
			$cities  = City::where('id', '!=', $account->currentAddress->city->id)
					   ->orderBy('name')
					   ->get();
		} else {
			$regions = Region::orderBy('code')->get();
			$cities  = City::orderBy('name')->get();
		}
		
		return view('account.manage-account', compact('account', 'regions', 'cities'));
	}
}
