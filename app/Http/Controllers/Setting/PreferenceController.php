<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserPreference;

class PreferenceController extends Controller
{
	public function __construct(UserPreference $preference)
	{
		$this->preference = $preference;
	}

    public function index()
    {
        $user = User::findOrFail(session('user_id'));
    	return view('settings.preference', compact('user'));
    }

    public function store()
    {
        $validated_attr = $this->validateRequest();

    	$this->preference->create($validated_attr + [
    		'user_id' 	 => session('user_id'),
    		'created_at' => now('Asia/Manila'),
    		'updated_at' => now('Asia/Manila'),
    	]);

    	return back();
    }

    public function update()
    {
        $validated_attr = $this->validateRequest();

		$preference = UserPreference::where('user_id', session('user_id'))->firstOrFail();
        $preference->update([
            'summary'    => request()->summary,
            'relocation' => (request()->has('relocation')) ? 1 : 0,
            'full_time'  => (request()->has('full_time')) ? 1 : 0,
            'part_time'  => (request()->has('part_time')) ? 1 : 0,
            'temporary'  => (request()->has('temporary')) ? 1 : 0,
            'contract'   => (request()->has('contract')) ? 1 : 0,
            'internship' => (request()->has('internship')) ? 1 : 0,
            'commission' => (request()->has('commission')) ? 1 : 0,
            'new_grad'   => (request()->has('new_grad')) ? 1 : 0,
            'privacy'    => request()->privacy,
        ]);

        return back();
	}

    protected function validateRequest(){
        return request()->validate([
            'summary'    => 'required',
            'relocation' => 'nullable',
            'full_time'  => 'nullable',
            'part_time'  => 'nullable',
            'temporary'  => 'nullable',
            'contract'   => 'nullable',
            'internship' => 'nullable',
            'commission' => 'nullable',
            'new_grad'   => 'nullable',
            'privacy'    => 'required',
        ]);   
    }
}
