<?php

namespace App\Http\Controllers\Setting;

use App\City;
use App\Http\Controllers\Controller;
use App\Region;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersonalInfoController extends Controller
{
	public function index(){
		$user = User::where('id', session('user_id'))
    				   ->with('current_address')
    				   ->firstOrFail();

    	if ($user->current_address != null) {
    		$regions = Region::where('id', '!=', $user->current_address->region->id)->orderBy('code')->get();
    		$cities  = City::where('id', '!=', $user->current_address->city->id)->orderBy('name')->get();
    	} else {
    		$regions = $this->regions();
    		$cities  = $this->cities();
    	}
		
		return view('settings.personal-info', compact('user', 'regions', 'cities'));
	}

	public function update()
	{
    	// validate
    	
    	$validated_attr = request()->validate([
    		'first_name' => 'required',
			'last_name'  => 'required',
			'username' 	 => 'required|unique:users,username,'.session('user_id'),
			'email' 	 => 'required|unique:users,email,'.session('user_id'),
			'birthdate'  => 'required',
    	]);

    	$validated_attr['birthdate'] = Carbon::parse(request()->birthdate);

		$user = User::findOrFail(session('user_id'));
		$user->update($validated_attr + ['updated_at' => now('Asia/Manila')]);

		return redirect()->back();
    }
}
