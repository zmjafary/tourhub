<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = true;
    	
    protected $fillable = [
        'title',
		'user_id',
		'type',
		'cost',
		'capacity',
		'description',
		'date_from',
		'date_to',
		'bookings_count',
		'created_at',
		'updated_at',
    ];

	protected $dates = ['date'];

    public function files()
    {
        return $this->hasMany(File::class);
    }

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function locations()
	{
		return $this->belongsToMany(Location::class);
	}
}