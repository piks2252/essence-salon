<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

	protected $table = "videos";
	protected $fillable = [
		'video_title','video_description','video_path'
	];

	protected $hidden = [
    ];
    
    public function getVideoPathAttribute($value) {
        if($value != '' && $value != null){
            return asset('assets/video/' .$value);
        }
        return $value;
	}
}
