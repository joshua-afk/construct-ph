<?php

namespace App;

class Job extends Model
{
	protected $dates = ['deadline', 'created_at', 'updated_at'];

	public function getRouteKeyName(){
		return 'code';
	}

	public function professional(){
		return $this->hasOne(User::class, 'id', 'entity_id');
	}

	public function client(){
		return $this->hasOne(User::class, 'id', 'entity_id');
	}

	public function company(){
		return $this->hasOne(Company::class, 'id', 'entity_id');
	}

	public function isFromClient(){
		return $this->entity_type == 3;
	}

	public function isFromProfessional(){
		return $this->entity_type == 1;
	}

	public function isFromCompany(){
		return $this->entity_type == 2;
	}

	public function job_qualification(){
		return $this->hasOne(JobQualification::class, 'job_id');
	}

	public function job_classifications(){
		return $this->hasMany(JobClassification::class, 'job_id');
	}

	public function entries(){
		return $this->hasMany(JobEntry::class, 'job_id')->latest('created_at');
	}
}
