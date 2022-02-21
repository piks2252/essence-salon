<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request) {
		$users = User::select('*')->get();
		return view('users.index',compact('users'));
	}

	public function destroy($id) {
		try {
			$user = User::findOrFail($id);
			$user->delete();
			return redirect()->back()->with('success','User Deleted successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

}
?>