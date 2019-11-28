<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\UserExperience;

class ExperienceController extends Controller
{
	public function __construct(UserExperience $experience)
	{
		$this->experience = $experience;
	}

	public function index()
	{
		$user = User::findOrFail(session('user_id'));
		return view('settings.experience', compact('user'));
	}

	public function store()
	{
		$validated_attr = request()->validate([
			'job_title' 	   => 'required',
			'company' 	       => 'required',
			'responsibilities' => 'nullable',
			'accomplishments'  => 'nullable',
			'skills'           => 'nullable',
			'started_at'       => 'required',
			'ended_at'         => 'required',
		]);

		$validated_attr['started_at'] = Carbon::parse(request()->started_at);
    	$validated_attr['ended_at']   = Carbon::parse(request()->ended_at);

		$this->experience->create($validated_attr + [
			'user_id'    => session('user_id'),
			'created_at' => now('Asia/Manila'),
			'updated_at' => now('Asia/Manila'),
		]);

		return back()->with('success', 'Experience successfully added.');
	}
}
