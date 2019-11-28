<?php

namespace App;

class JobInvitation extends Model
{
	public function job(){
		return $this->hasOne(Job::class, 'id', 'job_id');
	}

	public function isForProfessional(){
		return $this->entity_type == 1;
	}

	public function isForCompany(){
		return $this->entity_type == 2;
	}
}
