<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Company;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class CompanyController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request) {
		$companies = Company::select('*')->get();
		// return $quotes;
		return view('Company.index',compact('companies'));
	}
    
	public function create() {
        return view('Company.create');
    }

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required'
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		try {
			$comapny = new Company();
			$comapny->name = $request['name'];
			$comapny->save();
			
			return redirect()->action('CompanyController@create')->with('success','Company created successfully'); 

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function edit($id) {
		$company = Company::where('id', $id)->first();
		return view('Company.edit', compact('company'));
	}

	public function update(Request $request, $id) {
		$validator = Validator::make($request->all(), [
			'name' => 'required'
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		try {
			$company = Company::findOrFail($id);
			$comapny->name = $request['name'];
			$comapny->save();

			return redirect()->back()->with('success','Company updated successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	public function destroy($id) {
		try {
			$company = Company::findOrFail($id);
			$company->delete();
			return redirect()->back()->with('success','Company Deleted successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

}
?>