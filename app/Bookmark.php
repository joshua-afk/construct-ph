<?php

namespace App;

class Bookmark extends Model
{
    public function user(){
    	return $this->hasOne(User::class);
    }
}