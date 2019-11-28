<?php

namespace App;

class UserAddress extends Model
{
	public function region(){
		return $this->belongsTo(Region::class, 'region_id')->select('name');
	}

	public function city(){
		return $this->belongsTo(City::class, 'city_id')->select('name');
	}
}
