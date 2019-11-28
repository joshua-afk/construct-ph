<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
public function index(){
    	return view('admin.login');
    }

    public function store(Request $request){

        // Validate
        
        request()->validate([
            'username'    => 'required',
            'password'    => ['required', 'min:6'],
        ]);

        $user = User::where('username', $request->username)->orWhere('email', $request->username)->first();
        
        if ($user != '') {

            // Filter if not admin
            if ($user->id != 1) {
                session()->flash('message', 'These credentials do not match our records.');
                return redirect()->back()->withInput();
            }

            if (Hash::check($request->password, $user->password)) {
                    session()->put([
                        'user_id'             => $user->id,
                        'user_code'           => $user->code,
                        'user_username'       => $user->username,
                        'user_first_name'     => $user->first_name,
                        'user_middle_name'    => $user->middle_name,
                        'user_last_name'      => $user->last_name,
                        'user_type'           => $user->type,
                        'user_image'          => $user->image,
                        'user_session_token'  => $request->_token,
                    ]);
                    return redirect('/admin/dashboard');
            } else {
                session()->flash('message', 'These credentials do not match our records.');
            }
        } else {
            session()->flash('message', 'These credentials do not match our records.');
        }
        return redirect()->back()->withInput();
    }
}
