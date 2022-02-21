<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model {

	use SoftDeletes;
	protected $table = "staff";
	protected $fillable = [
		'name', 'gender', 'contact', 'date_of_birth', 'address', 'goverment_proof_id'
	];

	protected $hidden = [
	];
}
