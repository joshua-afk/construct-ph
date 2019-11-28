<?php

namespace App;

class Project extends Model
{
	// public function getRouteKeyName(){
	// 	return 'code';
	// }

// public function isFromCompany(){
//  return $this->hasOne('Company')->exists();
// }

	public function images(){
		return $this->hasMany(ProjectImage::class);
	}

	public function professional(){
		return $this->hasOne(User::class, 'id', 'entity_id');
	}

	public function company(){
		return $this->hasOne(Company::class, 'id', 'entity_id');
	}

	public function subscription(){
		return $this->hasOne(ProjectSubscription::class, 'project_id');
	}

	public function isFromProfessional(){
		return $this->where('entity_type', 1)->first();
	}

	public function isFromCompany(){
		return $this->where('entity_type', 2)->first();
	}
}