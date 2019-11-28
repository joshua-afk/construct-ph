<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Project;

class ProjectController extends Controller
{
    public function __construct(){
		$this->middleware('accounts.only');
	}
}
