<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model {

	protected $table = "deviceToken";
	protected $fillable = [
		'user_id','device_token'
	];

	protected $hidden = [
    ];
}
