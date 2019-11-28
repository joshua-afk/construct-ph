<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\UserAffiliation;

class AffiliationController extends Controller
{
	public function __construct(UserAffiliation $affiliation)
	{
		$this->affiliation = $affiliation;
	}

	public function index()
	{
		$user = User::findOrFail(session('user_id'));
		return view('settings.affiliation', compact('user'));
	}

    public function store()
    {
    	$validated_attr = request()->validate([
    		'organization_name' => 'required',
    		'position'   => 'required',
    		'started_at' => 'required',
    		'ended_at'   => 'required',
    		'status'     => 'required',
    	]);

    	$validated_attr['started_at'] = Carbon::parse(request()->started_at);
    	$validated_attr['ended_at']   = Carbon::parse(request()->ended_at);


    	$this->affiliation->create($validated_attr + [
    		'user_id' => session('user_id'),
    		'created_at' => now('Asia/Manila'),
    		'updated_at' => now('Asia/Manila'),
    	]);

    	return redirect()->back();
    }
}
