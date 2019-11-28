<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JobEntry;

class JobApplicationDeclineController extends Controller
{
    public function update(JobEntry $entry)
    {
    	$entry->status = JobEntry::IS_DECLINED;
    	$entry->save();

    	return back();
    }
}
