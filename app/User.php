<?php

namespace App;

class User extends Model
{	
	protected $hidden = ['password', 'code'];

	protected $dates = ['birthdate', 'date_activated', 'created_at', 'updated_at'];

	// public function getRouteKeyName(){
	// 	return 'username';  // Account::where('username', $key)->first();
	// }
	
	public function region(){
		return $this->hasOne(Region::class, 'id', 'region_id');
	}

	public function city(){
		return $this->hasOne(City::class, 'id', 'city_id');
	}

	public function bookmarks()
	{
		return $this->hasMany(Bookmark::class);
	}

	public function job_posts(){
		return $this->hasMany(Job::class, 'entity_id')->where('entity_type', '!=', 2);
	}

	public function job_invitations(){
		return $this->hasMany(JobInvitation::class, 'entity_id')->where('entity_type', '!=', 2);
	}

	public function job_bookmarks(){
		return $this->hasMany(Bookmark::class)->where('bookmark_type', 'Job');
	}

	public function addresses(){
		return $this->hasMany(UserAddress::class, 'user_id');
	}

	public function current_address(){
		return $this->hasOne(UserAddress::class, 'user_id')->where('current', 1);
	}

	public function preference(){
		return $this->hasOne(UserPreference::class, 'user_id');
	}

	public function companies(){
		return $this->hasMany(Company::class, 'user_id');
	}

	public function posts(){
		return $this->hasMany(Post::class, 'user_id');
	}

	public function classification(){
		return $this->hasOne(EntityClassification::class, 'entity_id')->where('entity_type', 1)->with('classification');
	}

	public function other_classifications(){
		return $this->hasMany(EntityOtherClassification::class, 'entity_id')->where('entity_type', 1)->with('classification');
	}

	public function projects(){
		return $this->hasMany(Project::class, 'entity_id');
	}

	public function experiences(){
		return $this->hasMany(UserExperience::class, 'user_id');
	}

	public function educations(){
		return $this->hasMany(UserEducation::class, 'user_id');
	}

	public function affiliations(){
		return $this->hasMany(UserAffiliation::class, 'user_id');
	}

	public function licensures(){
		return $this->hasMany(UserLicensure::class, 'user_id');
	}

	public function reviews(){
		return $this->hasMany(JobReview::class, 'for_id');
	}

	public function trainings(){
		return $this->hasMany(UserTraining::class, 'user_id');
	}

	public function social_account(){
		return $this->hasOne(UserSocial::class, 'user_id');
	}

	/**  Validations  **/

	public function hasSocial(){
		return $this->hasOne(UserSocial::class, 'user_id')->exists();
	}

	public function hasCompanies(){
		return $this->hasMany(Company::class, 'user_id')->exists();
	}

	public function isClient()
	{
		return $this->type === 2;
	}

	public function isProfessional()
	{
		return $this->type === 3;
	}

	public function isCompany()
	{
		return $this->type === 4;
	}

}
