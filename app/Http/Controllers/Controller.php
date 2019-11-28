<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use App\User;
use App\Classification;
use App\City;
use App\Region;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function uuid()
	{
		return (string) Str::uuid();
	}

	public function user($param, $val)
	{
		return User::where($param, $val)->firstOrFail();
	}

	public function regions()
	{
		return Region::orderBy('id')
			->select('id', 'code', 'name')
			->get();
	}

	public function cities()
	{
		return City::orderBy('name')
			->select('id', 'name')
			->get();
	}

	public function classifications()
	{
		return Classification::orderBy('code')
			->select('id', 'name')
			->get();
	}
}
