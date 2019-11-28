<?php

namespace App;

class UserSocial extends Model
{
	public function user(){
		return $this->hasOne(User::class, 'id', 'user_id');
	}    
}
