<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class VerifyJWTToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user()->status == 0) {
            return response()->json(['status' => 0, 'message' => trans('app.Your_account_is_not_activate_please_activated_first'), 'result' => null]);
        }
		return $next($request);
	}
}
