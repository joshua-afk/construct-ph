<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class TestController extends Controller
{
	public function index(){
		return abort(404);
		// return view('_test');
	}

    public function store(){
    	return request()->all();
    }
}
