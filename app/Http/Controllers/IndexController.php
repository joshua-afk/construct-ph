<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use App\Project;

class IndexController extends Controller
{
    public function __invoke()
    {   
    	$professionals     = User::where('type', 3)->get();
    	$contractors       = Company::where('type', 'contractor')
                                    ->select('code', 'pcab_license', 'company_name')
                                    ->get();
    	$suppliers         = Company::where('type', 'supplier')
                                    ->select('code', 'pcab_license', 'company_name')
                                    ->get();
        $featured_projects = Project::where('is_featured', true)
    						        ->select('code', 'name', 'description', 'image', 'is_featured')
    						        ->get();

    	return view('index', compact('professionals', 'contractors', 'suppliers', 'featured_projects'));
    }
}