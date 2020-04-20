<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
	protected $table = 'financial';
	protected $fillable = ['type', 'amount', 'user_id', 'category_id'];

	public function user() 
	{
		return $this->belongsTo(User::class);
	}

	public function category() 
	{
		return $this->belongsTo(Category::class);
	}
}
