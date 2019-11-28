<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Project;
use App\ProjectBlog;

class ProjectBlogController extends Controller
{
    public function create($uuid){
    	$project 	  = Project::where('code', $uuid)->firstOrFail();
    	$project_blog = ProjectBlog::where('user_id', session('user_id'))->first();
    	return view('project-blog.create', compact('project', 'project_blog'));
    }

    public function store($project){

        // validate

        $project = Project::where('code', $project)->firstOrFail();
        
        $eloquent =
        ProjectBlog::insert([
            'user_id'      => session('user_id'),
            'project_id'   => $project->id,
            'title'        => request()->title,
            'content'      => request()->content,
            'is_published' => 1,
            'created_at'   => Carbon::now('Asia/Manila'),
            'updated_at'   => Carbon::now('Asia/Manila'),
        ]);

        return redirect('/projects/'.$project->code);
    }


    public function edit($uuid){
    	$project 	  = Project::where('code', $uuid)->firstOrFail();
    	$project_blog = ProjectBlog::where('user_id', session('user_id'))
    					           ->first();
    	return view('project-blog.edit', compact('project', 'project_blog'));
    }

    public function update($uuid, ProjectBlog $blog){

        // validate
        
        $project = Project::where('code', $uuid)->first();

        $blog->update([
            'title' => request()->title,
            'content' => request()->content,
            'updated_at' => Carbon::now('Asia/Manila')
        ]);

       return redirect('/projects/'.$project->code);
    }
}
