<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function region(){
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function projects(){
        return $this->hasMany(Project::class, 'company_id');
    }

    public function jobs(){
    	return $this->hasMany(Job::class, 'company_id');
    }

    public function classification(){
        return $this->hasOne(EntityClassification::class, 'id', 'entity_id')->where('entity_type', 2)->with('classification');
    }

    public function other_classifications(){
        return $this->hasMany(EntityOtherClassification::class, 'id', 'entity_id')->where('entity_type', 2)->with('classification');
    }

    public function reviews(){
        return $this->hasMany(JobReview::class, 'for_id');
    }
}
