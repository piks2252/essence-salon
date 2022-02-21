<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Client;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class ClientController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request) {
		$clients = Client::select('*')->get();
		return view('clients.index',compact('clients'));
	}
    
	public function create() {
        return view('clients.create');
    }

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'gender' => 'required',
			'contact' => 'required|unique:client',
			'date_of_birth' => 'nullable|date_format:Y-m-d',
			'date_of_aniversary' => 'nullable|date_format:Y-m-d',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		try {
			$client = new Client();
			$client->name = $request['name'];
			$client->gender = $request['gender'];
			$client->contact = $request['contact'];
			$client->date_of_birth = $request['date_of_birth'];
			$client->date_of_aniversary = $request['date_of_aniversary'];
			$client->save();

			return redirect()->action('ClientController@create')->with('success','Client created successfully'); 

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function edit($id) {
		$data = Client::where('id', $id)->first();
		return view('clients.create', compact('data'));
	}

	public function update(Request $request, $id) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'gender' => 'required',
			'contact' => 'required|unique:client,contact,' . $id,
			'date_of_birth' => 'nullable|date_format:Y-m-d',
			'date_of_aniversary' => 'nullable|date_format:Y-m-d'
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		try {
			$client = Client::findOrFail($id);
			$client->name = $request['name'];
			$client->gender = $request['gender'];
			$client->contact = $request['contact'];
			$client->date_of_birth = $request['date_of_birth'];
			$client->date_of_aniversary = $request['date_of_aniversary'];
			$client->save();

			return redirect()->back()->with('success','Client updated successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function destroy($id) {
		try {
			$client = Client::findOrFail($id);
			$client->delete();
			return redirect()->back()->with('success','Client Deleted successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

}
?>