<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Project;
use App\ProjectBlog;
use App\ProjectBlogComment;

class ProjectBlogCommentController extends Controller
{
    public function store($project, ProjectBlog $blog){

    	// validate
    	
    	$project = Project::where('code', $project)->first();

    	$eloquent =
    	ProjectBlogComment::insert([
    		'project_id' => $project->id,
    		'blog_id' 	 => $blog->id,
    		'user_id' 	 => session('user_id'),
    		'comment' 	 => request()->comment,
    		'created_at' => Carbon::now('Asia/Manila'),
    		'updated_at' => Carbon::now('Asia/Manila'),
    	]);

		return redirect()->back();
    }
}
