<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;

class AboutController extends Controller
{
	public function __invoke()
	{
		Mapper::map(14.604495, 121.052620, ['zoom' => 15]);
		return view('about');
	}
}