<?php

namespace App;

class JobEntry extends Model
{
	const IS_PENDING = 'pending';
	const IS_ACCEPTED = 'accepted';
	const IS_DECLINED = 'declined';

	protected $dates = ['created_at', 'updated_at'];

	// public function user(){
	// 	return $this->belongsTo(User::class, 'user_id');
	// }

	// public function company(){
	// 	return $this->belongsTo(Company::class, 'company_id');
	// }

	public function job(){
		return $this->hasOne(Job::class, 'id', 'job_id');
	}

	public function review(){
		return $this->hasOne(JobReview::class, 'job_entry_id');
	}

	public function professional(){
		return $this->hasOne(User::class, 'id', 'entity_id');
	}

	public function company(){
		return $this->hasOne(Company::class, 'id', 'entity_id');
	}

	public function isFromProfessional(){
		return $this->where('entity_type', '===', 1);
	}

	public function isFromCompany(){
		return $this->where('entity_type', '===', 2);
	}
}
