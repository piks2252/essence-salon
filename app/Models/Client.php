<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model {

	use SoftDeletes;
	protected $table = "client";
	protected $fillable = [
		'name', 'gender', 'contact', 'date_of_birth', 'date_of_aniversary'
	];

	protected $hidden = [
	];
}
