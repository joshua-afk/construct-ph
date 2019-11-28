<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JobReview;
use App\JobEntry;

class JobReviewOwnerController extends Controller
{
    public function __construct(JobReview $review)
    {
        $this->review = $review;
    }

    public function store()
    {
        $job_entry = JobEntry::find(request()->job_entry_id);

    	$review = new JobReview;
    	$review->job_id 	  = request()->job_id;
    	$review->job_entry_id = request()->job_entry_id;
        $review->role         = JobReview::ROLE_OWNER;
        $review->from_id      = session('user_id');
        $review->for_id       = $job_entry->entity_id;
    	$review->rate 		  = (double)request()->rate;
    	$review->description  = request()->description;
    	$review->is_hidden    = false;
    	$review->save();

    	return back();
    }

    public function update(JobReview $review)
    {
    	// validate
        $review->update([
            'rate'        => request()->rate,
            'description' => request()->description,
            'updated_at'  => now('Asia/Manila'),
        ]);

        return back();
    }
}
