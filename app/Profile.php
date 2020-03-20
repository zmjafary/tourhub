<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = [
        'about', 'dob', 'gender', 'user_id',
    ];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	protected $dates = ['dob'];
}