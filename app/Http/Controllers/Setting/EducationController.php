<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\UserEducation;

class EducationController extends Controller
{
	public function __construct(UserEducation $education)
	{
		$this->education = $education;	
	}

	public function index()
	{
		$user = User::findOrFail(session('user_id'));
		return view('settings.education', compact('user'));
	}

    public function store()
    {
    	$validated_attr = $this->validateRequest();

    	$validated_attr['started_at'] = Carbon::createFromDate(request()->started_at, 1, 1);
    	$validated_attr['ended_at']   = Carbon::createFromDate(request()->ended_at, 1, 1);

    	$this->education->create($validated_attr + [
    		'user_id'    => session('user_id'),
    		'created_at' => now('Asia/Manila'),
    		'updated_at' => now('Asia/Manila'),
    	]);

    	return back()->with('succcess', 'Education successfully added.');
    }

    protected function validateRequest()
    {
    	return request()->validate([
    		"degree" 	 => 'required',
    		"field" 	 => 'required',
    		"school" 	 => 'required',
    		"started_at" => 'required',
    		"ended_at" 	 => 'required',
    	]);	
    }
}
