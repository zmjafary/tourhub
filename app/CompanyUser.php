<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
	protected $fillable = [
        'name','email','username','display','password','user_id'
    ];
    
    protected $hidden = [
        'password', 'deleted_at','created_at','updated_at','user_id'
    ];

    public function getDisplayAttribute($display)
    {
        return asset($display);
    }

	public function user()
	{
		return $this->belongsTo(User::class);
	}   
}
