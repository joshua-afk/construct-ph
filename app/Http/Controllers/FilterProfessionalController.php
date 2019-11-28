<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\AccountOtherClassification;
use App\Classification;
use App\Role;

class FilterProfessionalController extends Controller
{
	public function index(){
		$search              	  = [];
		$classifications          = Classification::orderBy('name')->get();
		$professional_accounts_id = Role::find(3)->accountRoles->pluck('account_id');
		$professionals 			  = Account::whereIn('id', $professional_accounts_id)
    								->orderBy('username')
    								->with(['overview', 'otherClassifications'])
    								->get();
		return view('all_professionals', compact('professionals', 'classifications', 'search'));
	}

	public function store(Request $request){

		$request->validate([
			'search' => 'required',
		]);

		$classifications          = Classification::orderBy('name')->get();
		$professional_accounts_id = Role::find(3)->accountRoles->pluck('account_id');
		$search 				  = Classification::whereIn('name', $request->search)->get();;
		
		$filtered_accounts_id = [];
		$accounts_with_specialty = AccountOtherClassification::whereIn('classification', $request->search)->where('account_id', $professional_accounts_id)->get();
		foreach ($accounts_with_specialty as $specialty) {
			if(!in_array($specialty->account_id, $filtered_accounts_id)){
				array_push($filtered_accounts_id, $specialty->account_id);
			}
		}

		$professionals 	= Account::whereIn('id', $filtered_accounts_id)
    						->orderBy('username')
	    					->with(['overview', 'classifications'])
    						->get();
		return view('all_professionals', compact('professionals', 'classifications', 'search'));
	}
}
