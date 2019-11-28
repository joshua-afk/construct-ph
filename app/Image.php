<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function postImages(){
        return $this->hasMany(PostImage::class, 'image_id');
    }
}
