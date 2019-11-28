<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Project;
use App\ProjectBlog;
use App\ProjectBlogComment;

class ProjectController extends Controller
{
    public function index()
    {
        // return view('');
        return 1;
    }


    public function create()
    {
        return view('project.create');
    }


    public function store()
    {
        $uuid = $this->uuid();

        if(request()->hasFile('cover_image')){
            $file = request()->file('cover_image')->getClientOriginalName();
            $file_name = pathinfo($file, PATHINFO_FILENAME);
            $file_extension = request()->file('cover_image')->getClientOriginalExtension();
            $file_store = $file_name.'_'.time().'.'.$file_extension;
        } else {
            $file_store = 'no-image.jpg';
        }

        // Save the project.
        $eloquent =
        Project::insert([
            'code'        => $uuid,
            'name'        => request()->project_name,
            'description' => request()->description,
            'image'       => $file_store,
            'entity_type' => 1,
            'entity_id'   => session('user_id'),
            'date_start'  => Carbon::parse(request()->date_start),
            'date_finish' => Carbon::parse(request()->date_finish),
            'status'      => 1,
            'created_at'  => Carbon::now('Asia/Manila'),
            'updated_at'  => Carbon::now('Asia/Manila')
        ]);
        
        // If project is saved, insert the image in storage.
        if ($eloquent == true) {
            if ($file_store != 'no-image.jpg') {
                request()->file('cover_image')->storeAs('public/images/projects/cover-images', $file_store);
            }
        }

        $project = Project::where('code', $uuid)->first();

        return redirect('/projects/'. $project->code);
    }


    public function show($uuid)
    {
        $project       = Project::where('code', $uuid)
                                ->with('images', 'professional')
                                ->firstOrFail();
        $project_blog  = ProjectBlog::where('user_id', session('user_id'))
                                    ->where('project_id', $project->id)
                                    ->with('user', 'comments', 'comments.user')
                                    ->first();

        return view('project.show', compact('project', 'project_blog'));
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
