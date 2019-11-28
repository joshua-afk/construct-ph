<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job;
use App\JobReview;

class JobReviewApplicantController extends Controller
{
    public function __construct(JobReview $review)
    {
        $this->review = $review;
    }

    public function store()
    {
        $job = Job::find(request()->job_id);

    	$review = new JobReview;
    	$review->job_id 	  = request()->job_id;
    	$review->job_entry_id = request()->job_entry_id;
        $review->role         = JobReview::ROLE_APPLICANT;
        $review->from_id      = session('user_id');
        $review->for_id       = $job->entity_id;
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