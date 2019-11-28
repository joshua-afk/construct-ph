<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Region;
use App\City;
use App\AccountPreference;
use App\AccountEducation;
use App\AccountExperience;
use App\ResumeTraining;
use App\AccountLicensure;
use App\AccountAffiliation;

class CredentialController extends Controller
{
	public function __construct()
	{
		$this->middleware('accounts.only');
	}

    public function index()
    {
		$account 	 = Account::where('code', session('account_code'))
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

		$account_preferences  = AccountPreference::where('account_id', session('account_id'))->first();
		$account_educations   = AccountEducation::where('account_id', session('account_id'))->get();
		$account_experiences  = AccountExperience::where('account_id', session('account_id'))->get();
		$resume_trainings  	  = ResumeTraining::where('account_id', session('account_id'))->get();
		$account_affiliations = AccountAffiliation::where('account_id', session('account_id'))->get();
		$account_licensures   = AccountLicensure::where('account_id', session('account_id'))->get();

    	return view('account.manage-credentials', compact('account', 'regions', 'cities', 'account_preferences', 'account_educations', 'account_experiences', 'resume_trainings', 'account_affiliations', 'account_licensures'));
    }
}
