<?php

namespace App\Http\Controllers;

use App\Events\EventLogged;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
	public function __construct()
	{
		$this->middleware('accounts.only');
	}
	
    public function destroy()
    {
    	$user_id = session('user_id');

    	session()->flush();
    	event(new EventLogged($user_id, 'Logout', 'User Logged Out'));
    	
        return redirect('/');
    }
}