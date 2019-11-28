<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    public function post(){
        return $this->hasMany(Post::class, 'type_id');
    }
}
