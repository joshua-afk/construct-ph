<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	public function company(){
		return $this->hasMany(Company::class, 'city_id');
	}

	public function province(){
		return $this->belongsTo(City::class, 'province_id');
	}
}
