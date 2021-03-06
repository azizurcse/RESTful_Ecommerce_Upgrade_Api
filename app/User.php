<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use App\Transformers\UserTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    CONST VERIFIED_USER='1';
    CONST UNVERIFIED_USER='0';
    CONST ADMIN_USER='true';
    CONST REGULAR_USER='false';
    protected $table='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $transformer=UserTransformer::class;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'name', 'email', 'password','verified','verification_token','admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','verification_token'
    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name']=strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }


    public function setEmailAttribute($email)
    {
        $this->attributes['email']=strtolower($email);
    }

    public function isVerified()
    {
        return $this->verified==User::VERIFIED_USER;
    }

    public function isAdmin()
    {
        return $this->admin==User::ADMIN_USER;
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }
}
