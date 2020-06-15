<?php

namespace App;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Providers\RouteServiceProvider;

class SuperUsers extends Authenticatable
{
    use Notifiable;

    protected $table = 'super_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getAllPermissionsAttribute()
    // {
    //     $permissions = [];

    //     foreach (Permission::all() as $permission) 
    //         if (auth()->guard('super_user')->user()->can($permission->name)) 
    //             $permissions[] = $permission->name;

    //     return $permissions;            
    // }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
