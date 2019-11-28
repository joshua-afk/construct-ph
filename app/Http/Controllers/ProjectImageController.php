<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectImage;

class ProjectImageController extends Controller
{
    public function create($uuid){
    	$project = Project::where('code', $uuid)->first();
    	return view('project-image.add', compact('project'));
    }

    // public function store(Request $request){
    // 	return $request->all();
    // }

    public function update(Request $request){
    	$image = ProjectImage::findOrFail($request->id);
    	$image->description = $request->description;
    	$image->save();
    	return redirect()->back();
    }
}