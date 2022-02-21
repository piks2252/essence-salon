<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Service;
use App\Models\Staff;

class ClientService extends Model {

	use SoftDeletes;
	protected $table = "client_services";
	protected $fillable = [
		'invoice_id', 'Invoice_no', 'service_id', 'service_price' , 'operator_id'
	];

	protected $hidden = [
	];

	public function services()
	{
	    return $this->hasOne(Service::class, 'id', 'service_id');
	}
	public function operator()
	{
	    return $this->hasOne(Staff::class, 'id', 'operator_id');
	}
}
