<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JobEntry;

class JobApplicationAcceptController extends Controller
{
    public function update(JobEntry $entry){

    	$entry->status = JobEntry::IS_ACCEPTED;
    	$entry->save();
    	
    	return redirect()->back();
    }
}
