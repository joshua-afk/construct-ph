<?php

namespace App;

class Log extends Model
{
    public function user(){
    	return $this->hasOne(User::class, 'id', 'user_id');
    }
}
