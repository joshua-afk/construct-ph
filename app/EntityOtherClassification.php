<?php

namespace App;

class EntityOtherClassification extends Model
{
	public function isFromProfessional(){
		return $this->entity_type = 1;
	}

	public function isFromCompany(){
		return $this->entity_type = 2;
	}

	public function professional(){
		return $this->hasOne(User::class, 'id', 'entity_id');
	}

	public function company(){
		return $this->hasOne(Company::class, 'id', 'entity_id');
	}

	public function classification(){
		return $this->belongsTo(Classification::class, 'classification_id');
	}
}
