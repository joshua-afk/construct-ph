<?php

namespace App\Http\Controllers\Account;

use App\Events\UserLoggedIn;
use App\Http\Controllers\Controller;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){

    	$user= User::find(session('user_key'));

    	if (is_null($user) && session('provider') == 'facebook') {
    		return redirect('/login/facebook');
    	} elseif (is_null($user) && session('provider') == 'google') {
            return redirect('/login/google');
        }

    	return view('account.account-role', compact('user'));
    }

    public function store(){

    	$user = User::find(request()->user_id);

    	switch (request()->role) {
    		case 'client':
    		$role = 2;
    		break;
    		case 'professional':
    		$role = 3;
    		break;
    		case 'company':
    		$role = 4;
    		break;
    	}

        $user->update([
            'type' => $role
        ]);

        event(new UserLoggedIn($user, request()->_token));

    	return redirect('/jobs');
    }
}
