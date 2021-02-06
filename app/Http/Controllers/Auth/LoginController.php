<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user) {
		if ($user->is_admin == 0) {
			Auth::logout();
			return redirect()->back()->with('err_status', trans('auth.permission'))->withInput();
		}else if ($user->is_admin == 1 && $user->status != 1) {
			Auth::logout();
			return redirect()->back()->with('err_status', trans('auth.your_account_is_not_activated'))->withInput();
        }
        return redirect()->route('users.index');
	}

    public function redirectTo() {
        $redirectTo = '/users';
        // dd($redirectTo);
        return redirect()->route('users.index');
    }

}
