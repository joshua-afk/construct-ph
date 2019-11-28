<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Project;

class ProjectUnfeatureController extends Controller
{
    public function update(Project $project)
    {
    	$project->update([
    		'is_featured' => FALSE,
    		'updated_at'  => Carbon::now('Asia/Manila'),
    	]);
    
    	$project->subscription->delete();

    	return redirect()->back();
    }
}
