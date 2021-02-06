<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Models\PaymentTransaction;
use App\Models\DeviceToken;
use App\Models\StoreTableDetail;
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
		// return $users;
		return view('users.index',compact('users'));
	}

	public function destroy($id) {
		try {
			$user = User::findOrFail($id);
			if(PaymentTransaction::where('user_id',$id)->exists()){
				PaymentTransaction::where('user_id',$id)->delete();
			}
			if(DeviceToken::where('user_id',$id)->exists()){
				DeviceToken::where('user_id',$id)->delete();
			}
			if(StoreTableDetail::where('user_id',$id)->exists()){
				StoreTableDetail::where('user_id',$id)->delete();
			}
			$user->delete();
			return redirect()->back()->with('success','User Deleted successfully');

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

}
?>