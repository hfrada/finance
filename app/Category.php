<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'category';
    protected $fillable = ['category'];

    public function financial() 
    {
    	return $this->hasMany(Financial::class);
    }
}
