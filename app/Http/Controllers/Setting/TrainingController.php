<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\UserTraining;

class TrainingController extends Controller
{
	public function __construct(UserTraining $training)
	{
		$this->training = $training;
	}

	public function index()
	{
		$user = User::findOrFail(session('user_id'));
		return view('settings.training', compact('user'));
	}

	public function store()
	{	
		$validated_attr = request()->validate([
			'title'       => 'required',
			'company'     => 'required',
			'cert_number' => 'required',
			'started_at'  => 'required',
			'ended_at'    => 'required',
		], [
			'cert_number.required' => 'The certificate number field is required.',
			'started_at.required' => 'The started date field is required.',
			'ended_at.required' => 'The ended date field is required.',
		]);

		$validated_attr['started_at'] = Carbon::parse(request()->started_at);
		$validated_attr['ended_at']   = Carbon::parse(request()->ended_at);

		$this->training->create($validated_attr + [
			'user_id' => session('user_id'),
			'created_at' => now('Asia/Manila'),
			'updated_at' => now('Asia/Manila'),
		]);

		return back()->with('success', 'Training successfully added.');
	}
}
