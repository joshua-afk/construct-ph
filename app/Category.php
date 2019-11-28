<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function jobCategory(){
		return $this->hasMany(JobCategory::class, 'cat_id');
	}

	public function subCategories(){
		return $this->hasMany(SubCategory::class, 'cat_id');
	}
}
