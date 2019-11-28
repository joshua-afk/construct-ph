<?php

namespace App;

class ProjectBlog extends Model
{
	public function user(){
    	return $this->hasOne(User::class, 'id', 'user_id');
	}

    public function comments(){
    	return $this->hasMany(ProjectBlogComment::class, 'blog_id');
    }
}
