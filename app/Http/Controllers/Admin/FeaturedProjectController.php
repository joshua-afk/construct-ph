<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class FeaturedProjectController extends Controller
{
    public function index(){
    	$projects = Project::latest()->get();
    	return view('admin.featured-projects.index', compact('projects'));
    }
}