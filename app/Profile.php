<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
	protected $fillable = ['gender', 'place_of_birth', 'date_of_birth', 'contact_number', 'address', 'user_image', 'bio'];

	public function super_users()
	{
		return $this->hasMany(SuperUsers::class);
	}
}
