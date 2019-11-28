<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Job;
use App\JobEntry;

class JobApplicationController extends Controller
{
    public function store(Job $job){

    	// validate

        $company_id = request()->get('company', 0);

        JobEntry::insert([
            'job_id'      => $job->id,
            'entity_type' => request()->entity_type,
            'entity_id'   => request()->entity_id,
            'proposal'    => request()->proposal,
            'status'      => JobEntry::IS_PENDING,
            'created_at'  => Carbon::now('Asia/Manila'),
            'updated_at'  => Carbon::now('Asia/Manila'),
        ]);

    	return redirect()->back();
    }

    public function update(Job $job, JobEntry $entry){
        
        // validate
        
        $entry->update([
            'entity_id' => request()->entity_id,
            'proposal'   => request()->proposal_update,
            'updated_at' => Carbon::now('Asia/Manila'),
        ]);

        return redirect()->back();
    }
}
