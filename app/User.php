<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type','email', 'password', 'status', 'username','display', 'fcm_token', 'phone_no',
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
    
    public function getDisplayAttribute($display)
    {
        return asset($display);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function companyUser()
    {
        return $this->hasMany(CompanyUser::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function addProfile($attributes)
    {
        return $this->profile()->create($attributes);
    }

    public function addCompany($attributes)
    {
        return $this->company()->create($attributes);
    }

    public function updateProfile($attributes)
    {
        return $this->profile->update($attributes);
    }

    public function updateCompany($attributes)
    {
        return $this->company->update($attributes);
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
}