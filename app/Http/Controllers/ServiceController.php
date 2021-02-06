<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Service;
use Auth;
use Illuminate\Http\Request;
use Validator;

class ServiceController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request) {
		$datas = Service::select('*')->get();
		return view('services.index',compact('datas'));
	}

	public function create() {
        return view('services.create');
    }

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'price' => 'required'
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		try {
			$client = new Service();
			$client->service_name = $request['name'];
			$client->price = $request['price'];
			$client->save();

			return redirect()->action('ServiceController@create')->with('success','Service created successfully'); 

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function edit($id) {
		$data = Service::where('id', $id)->first();
		return view('services.create', compact('data'));
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