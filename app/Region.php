<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	public function country(){
		return $this->belongsTo(Country::class, 'country_id');
	}

	public function companies(){
		return $this->hasMany(Company::class, 'region_id');
    }

    public function provinces(){
    	return $this->hasMany(Province::class, 'region_id');
    }    
}
