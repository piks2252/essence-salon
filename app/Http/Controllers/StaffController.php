<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Staff;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class StaffController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request) {
		$datas = Staff::select('*')->get();
		// return $clients;
		return view('staff.index',compact('datas'));
	}
    
	public function create() {
        return view('staff.create');
    }

	public function store(Request $request) {
		// dd($request->all());
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'gender' => 'required',
			'address' => 'required',
			'contact' => 'required|unique:staff',
			'date_of_birth' => 'nullable|date_format:Y-m-d',
			'goverment_proof_id' => 'nullable|image'
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		try {
			$client = new Staff();
			$client->name = $request['name'];
			$client->gender = $request['gender'];
			$client->contact = $request['contact'];
			$client->address = $request['address'];
			$client->date_of_birth = $request['date_of_birth'];
			$image = $request->file('goverment_proof_id');
			if(!empty($image)){

                $fileName = $request['name'].'-' . date('YmdHsi') . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path() . '/assets/images/goverment-ids/';
                $image->move($destinationPath, $fileName);
				$client->goverment_proof_id = $fileName;
			}
			$client->save();

			return redirect()->action('StaffController@create')->with('success','Staff member created successfully'); 

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function edit($id) {
		$data = Staff::where('id', $id)->first();
		return view('staff.create', compact('data'));
	}

	public function update(Request $request, $id) {
		// dd($request->all());
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'gender' => 'required',
			'address' => 'required',
			'contact' => 'required|unique:staff,contact,' . $id,
			'date_of_birth' => 'nullable|date_format:Y-m-d',
			'goverment_proof_id' => 'nullable|image'
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		try {
			$client = Staff::findOrFail($id);
			$client->name = $request['name'];
			$client->gender = $request['gender'];
			$client->contact = $request['contact'];
			$client->address = $request['address'];
			$client->date_of_birth = $request['date_of_birth'];
			$image = $request->file('goverment_proof_id');
			// dd($request->all());
			if(!empty($image)){
                $fileName = $request['name'].'-' . date('YmdHsi') . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path() . '/assets/images/goverment-ids/';
                // dd($destinationPath . $client->goverment_proof_id);
                    if (!empty($client->goverment_proof_id) && file_exists($destinationPath . $client->goverment_proof_id)) {
                		chmod($destinationPath . $client->goverment_proof_id, 0777); 
                        unlink($destinationPath . $client->goverment_proof_id);
                    }
                $image->move($destinationPath, $fileName);
				$client->goverment_proof_id = $fileName;
			}
			$client->save();

			return redirect()->back()->with('success','Staff member updated successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function destroy($id) {
		try {
			$client = Staff::findOrFail($id);
			$destinationPath = public_path() . '/assets/images/goverment-ids/';
			if (!empty($client->goverment_proof_id) && file_exists($destinationPath . $client->goverment_proof_id)) {
        		chmod($destinationPath . $client->goverment_proof_id, 0777); 
                unlink($destinationPath . $client->goverment_proof_id);
            }
			$client->delete();
			return redirect()->back()->with('success','Staff Deleted successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

}
?>