<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function roleModules(){
        return $this->hasMany(RoleModule::class, 'module_id');
    }
}
