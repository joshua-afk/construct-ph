<?php

namespace App;

class JobClassification extends Model
{
	protected $dates = ['created_at', 'updated_at'];
	
    public function classification(){
    	return $this->belongsTo(Classification::class, 'classification_id');
    }
}
