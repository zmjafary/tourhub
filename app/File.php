<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $guarded = [];
	
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getFilePathAttribute($file_path)
    {
        return asset($file_path);
    }
}
