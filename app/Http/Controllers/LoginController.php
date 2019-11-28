<?php

namespace App\Http\Controllers;

use App\Company;
use App\Events\EventLogged;
use App\Events\UserLoggedIn;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guests.only');
        $this->middleware('throttle:5,1')->only('store');
    }
    
    public function index(){
    	return view('authentication.login');
    }

    public function store(Request $request){

        request()->validate([
            'username' => 'required',
            'password' => ['required', 'min:6'],
        ]);

        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

        if ($user != '')
        {
            // Check if the logged in user is admin or has social account
            if ($user->id == 1 || $user->hasSocial()) {
                session()->flash('message', 'These credentials do not match our records.');
                return redirect()->back()->withInput();
            }

            // If password is TRUE, proceed..
            if (Hash::check($request->password, $user->password)){

                // Store user session
                event(new UserLoggedIn($user, $request->_token));

                // Log
                event(new EventLogged(session('user_id'), 'Login', 'User Logged In'));

                // Check if the user is role of company
                if (session('user_type') == 4) {
                    
                    $user_companies = Company::where('user_id', $user->id)->get();
                    
                    // If user doesn't have company. Redirect to create
                    if ($user_companies->isEmpty()) {
                        return redirect('/companies/create');
                    } else {
                        return redirect('/profile');
                    }
                }

                // If user is not a company
                if ($request->has('redirect')) {
                    return redirect($request->redirect);
                }
                return redirect('/profile');
            } else {
                session()->flash('message', 'These credentials do not match our records.');
            }
        } else {
            session()->flash('message', 'These credentials do not match our records.');
        }
        session()->flash('message', 'These credentials do not match our records.');
        return redirect()->back()->withInput();
    }
}