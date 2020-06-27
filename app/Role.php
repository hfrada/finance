<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
	protected $fillable = ['access_name', 'permission'];

    public function superuser() 
    {
    	return $this->hasMany(SuperUsers::class);
    }
}
