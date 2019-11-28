<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class DashboardController extends Controller
{
    public function index(){
    	$professional_projects = Project::all();
    	return view('admin.dashboard', compact('professional_projects'));
    }
}
