<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Company;

class CompanyController extends Controller
{
	public function __construct()
	{
		$this->middleware('accounts.only');
	}

	public function index()
	{
		$user 		    = User::where('username', session('user_username'))->firstOrFail();
		$user_companies = Company::where('user_id', $user->id)->get();
		return view('account-company.index', compact('user', 'user_companies'));
	}

	public function show($uuid)
	{
		$user 	 = User::where('username', session('user_username'))->firstOrFail();
		$company = Company::where('code', $uuid)->firstOrFail();
		$ratings_average = (count($company->reviews) !== 0) ? (array_sum($company->reviews->pluck('rate')->toArray()) / count($company->reviews)) : 0 ;
		return view('account-company.show', compact('user', 'company', 'ratings_average'));
	}

	public function edit($uuid)
	{
		$user 	 = User::where('username', session('user_username'))->firstOrFail();
		$company = Company::where('code', $uuid)->firstOrFail();
		return view('account-company.edit', compact('user', 'company'));
	}
}
