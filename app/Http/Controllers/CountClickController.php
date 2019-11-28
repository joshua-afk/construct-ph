<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserClick;

class CountClickController extends Controller
{
    // public function __construct(UserClick $user_click)
    // {
    //     $this->user_click = $user_click;
    // }

    public function store(Request $request, $username)
    {
    	$user = User::where('username', $username)->firstOrFail();

    	if (!session()->has('user_id')) {
            return redirect('/login')->with(['login' => 'Please login to continue.', 'redirect' => '/profile/'.$username]);
        }

    	$click = new UserClick;
    	$click->user_id = $user->id;
    	$click->ip_address = $request->ip();
    	$click->save();
    	
    	return redirect('/profile/'.$user->username);
    }
}