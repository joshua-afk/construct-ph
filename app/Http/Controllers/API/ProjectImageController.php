<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Project;
use App\ProjectImage;

class ProjectImageController extends Controller
{
    public function store($uuid){

    	// request()->validate([
    	// 	'file' => 'unique:files,file|max:9999|mimes:doc,docx,pdf,odt,xls,xlsx,ods,ppt,pptx,txt',
    	// ]);

    	$file = request()->file('file')->getClientOriginalName();
    	$file_name = pathinfo($file, PATHINFO_FILENAME);
    	$file_extension = request()->file('file')->getClientOriginalExtension();
    	$file_store = $file_name.'_'.time().'.'.$file_extension;

    	$project = Project::where('code', $uuid)->first();

        $eloquent = ProjectImage::insert([
            'project_id'  => $project->id,
            'image'       => $file_store,
            'description' => null,
            'created_at'  => Carbon::now('Asia/Manila'),
            'updated_at'  => Carbon::now('Asia/Manila'),
        ]);

		if ($eloquent) {
			$upload_success = request()
                              ->file('file')
                              ->move(storage_path('/app/public/images/projects/professional'), $file_store);
			return response()->json(['success'=>'You have successfully upload file.']);
		}

		return response()->json(['error'=>'Upload failed.']);
    }
}
