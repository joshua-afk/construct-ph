<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class SecurityController extends Controller
{
	public function __construct(){
		$this->middleware('accounts.only');
	}

	public function index()
	{
		$user = User::findOrFail(session('user_id'));
		return view('settings.security', compact('user'));
	}
}
