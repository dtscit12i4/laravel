<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Utils\ExtendSoftDeletes;

class User extends Model
{

    // use SoftDeletes;
    use ExtendSoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'login_name', 'role', 'password', 'deleted_at_by',
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
    * Hash password
    *
    * @param string $value
    * @return string
    */
   public function setPasswordAttribute($value)
   {
       $this->attributes['password'] = \Hash::make($value);
   }
}
