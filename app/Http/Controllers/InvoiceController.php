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
use Carbon\CarbonPeriod;

class InvoiceController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request) {
		$datas = Invoice::with('clients','clientServices','clientServices.services','clientServices.operator');
		$operators = Staff::all();
		if($request->startDate){
			$datas = $datas->where('created_at', '>=' , $request->startDate);
		}
		if($request->endDate){
			$datas = $datas->where('created_at', '<=' , $request->endDate);
		}
		$datas = $datas->get();		
		return view('invoices.index',compact('datas','operators'));
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
		$data = Invoice::where('id', $id)->with('clients','clientServices','clientServices.services','clientServices.operator')->first();
		dd($data->toArray());
		return view('invoices.create', compact('data'));
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
			DB::transaction(function() use($id) {
				$invoice = Invoice::findOrFail($id);
				$invoice->delete();

				$client_services = ClientService::where('invoice_id',$id)->delete();
			});
			return redirect()->back()->with('success','Service Deleted successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function report(Request $request) {
		try {
			$period = CarbonPeriod::create(\Carbon\Carbon::now()->subYears(1)->toDateString(), '1 month', \Carbon\Carbon::now()->toDateString());
			$labels = collect($period)->map(function ($date) {
			   return  \carbon\Carbon::parse($date)->format('M-Y');
			})->toArray();

			$report = ClientService::select(DB::raw("count(*) as services"), DB::raw("YEAR(client_services.created_at) year, MONTH(client_services.created_at) month, CONCAT(MONTH(client_services.created_at),'-' ,YEAR(client_services.created_at)) as label, staff.name as operator"))
					  ->join('staff', 'client_services.operator_id', '=', 'staff.id')
					  ->join('services', 'client_services.service_id', '=', 'services.id');
					  	$report->where('client_services.created_at','>=', \Carbon\Carbon::now()->subYears(1));
					  	$report->where('client_services.created_at','<=', \Carbon\Carbon::now());
					  $report = $report->groupBy('year','month')
					  ->get();
			$report = $report->groupby('operator');
			dd($report->toArray());
			return response()->json(['report'=>$report]);


		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}
}
?>