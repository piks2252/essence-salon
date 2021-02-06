<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model {

	protected $table = "audios";
	protected $fillable = [
		'audio_title','audio_description','audio_path'
	];

	protected $hidden = [
    ];
    
    public function getAudioPathAttribute($value) {
        if($value != '' && $value != null){
            return asset('assets/audio/' .$value);
        }
        return $value;
	}
}
