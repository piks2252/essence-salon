<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Staff;
use App\Models\Service;
use App\Models\ClientService;
use Auth;
use Illuminate\Http\Request;
use Validator;
use DB;

class InvoiceController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request) {
		$datas = Invoice::with('clients','clientServices','clientServices.services','clientServices.operator')->get();
		// foreach ($datas->toArray() as $key => $value) {
		// 	# code...
		// dd($value["client_services"]);
		// }		
		return view('invoices.index',compact('datas'));
	}

	public function create() {
		$clients = Client::select('*')->get();
		$operators = Staff::select('*')->get();
		$services = Service::select('*')->get();
        return view('invoices.create',compact('clients','operators', 'services'));
    }

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'client_id' => 'required|numeric',
			'discount' => 'required|numeric|min:0|max:100',
			'total_amount' => 'required|numeric|min:0',
			'client_services.*.service_id' => 'required|numeric|min:0',
			'client_services.*.operator_id' => 'required|numeric|min:0',
			'client_services.*.service_price' => 'required|numeric|min:0'
		]);

		if ($validator->fails()) {
			return response()->json($validator->messages(), 400);
		}

		try {
			DB::transaction(function() use($request) {
				$invoice = new Invoice();
				$invoice->client_id = $request->client_id;
				$invoice->discount = $request->discount;
				$invoice->total_amount = $request->total_amount;
				$invoice->save();
				$invoice_id = $invoice->id;
				$datas = $request["client_services"];
				foreach ($datas as $key => $value) {
				    $value['invoice_id'] = $invoice_id;
				    $value['created_at'] = \Carbon\Carbon::now();
				    $value['updated_at'] = \Carbon\Carbon::now();
				    $datas[$key] = $value;
				}

				$client_service = new ClientService();
				$client_service->insert($datas);
			});
				return response()->json(["message"=>"Invoice created successfully"], 200);

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function edit($id) {
		$services = Service::where('id', $id)->first();
		return view('services.create', compact('services'));
	}

	public function update(Request $request, $id) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'price' => 'required',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		try {
                $services = Service::findOrFail($id);
                $services->service_name = $request->name;
                $services->price = $request->price;
                $services->save();

			return redirect()->back()->with('success','Service updated successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function destroy($id) {
		try {
			$client = Service::findOrFail($id);
			$client->delete();
			return redirect()->back()->with('success','Service Deleted successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}
}
?>