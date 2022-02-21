<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ClientService;
use App\Models\Client;

class Invoice extends Model {

	use SoftDeletes;
	protected $table = "invoice";
	protected $fillable = [
		'client_id', 'Invoice_no', 'discount', 'total_amount'
	];

	protected $hidden = [
	];

	public function clientServices()
	{
	    return $this->hasMany(ClientService::class, 'invoice_id');
	}
	public function clients()
	{
	    return $this->hasOne(Client::class, 'id', 'client_id');
	}
}
