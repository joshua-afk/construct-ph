<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserLicensure;

class LicensureController extends Controller
{
	public function __construct(UserLicensure $licensure)
	{
		$this->licensure = $licensure;	
	}

    public function index()
    {
    	$user = User::findOrFail(session('user_id'));
    	return view('settings.licensure', compact('user'));
    }

    public function store()
    {
    	$validated_attr = request()->validate([
    		'type'         => 'required',
    		'name'         => 'required',
    		'number'       => 'required|numeric',
    	]);

    	$this->licensure->create($validated_attr + [
    		'user_id' => session('user_id'),
    		'created_at' => now('Asia/Manila'),
    		'updated_at' => now('Asia/Manila'),
    	]);

    	return back()->with('success', 'Licensure successfully added.');	
    }
}
