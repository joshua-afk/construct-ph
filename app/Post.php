<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type(){
        return $this->belongsTo(PostType::class, 'type_id');
    }

    public function images(){
        return $this->belongsTo(PostImage::class, 'post_id');
    }
}
