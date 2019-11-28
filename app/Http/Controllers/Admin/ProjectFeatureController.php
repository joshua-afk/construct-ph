<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Project;
use App\ProjectSubscription;

class ProjectFeatureController extends Controller
{
    public function update(Project $project){

    	// Update project feature status
    	$project->update([
    		'is_featured' => TRUE,
    		'updated_at'  => Carbon::now('Asia/Manila'),
    	]);

    	// Insert Project Subscription
    	ProjectSubscription::insert([
    		'entity_type' => $project->entity_type,
    		'entity_id'   => $project->entity_id,
    		'project_id'  => $project->id,
    		'expire_at'   => Carbon::now('Asia/Manila')->addYear(1),
    		'created_at'  => Carbon::now('Asia/Manila'),
    		'updated_at'  => Carbon::now('Asia/Manila'),
    	]);

    	return redirect()->back();
    }
}