<?php

namespace App;

class JobReview extends Model
{
	const ROLE_OWNER 	 = 'owner';
	const ROLE_APPLICANT = 'applicant';

	public function job(){
		return $this->hasOne(Job::class, 'id', 'job_id');
	}

	public function job_entry(){
		return $this->hasOne(JobEntry::class, 'id', 'job_entry_id');
	}
}
