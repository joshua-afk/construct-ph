<?php

namespace App;

class ProjectBlogComment extends Model
{
    public function user(){
    	return $this->hasOne(User::class, 'id', 'user_id');
    }
}
