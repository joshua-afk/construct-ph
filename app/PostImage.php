<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function image(){
    	return $this->belongsTo(Image::class, 'image_id');
    }
}
