<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Exception;

class PurchaseBookController extends Controller
{   
    public function __construct(){
    }
    
    public function purchasePdf(Request $request)
    {
        try {
            if($request->user()->is_book_purchased < 1){
                $user_data = User::findOrFail($request->user()->id);
                $user_data->is_book_purchased = 1;
                $user_data->save();
            }
            // return response()->json(['status' => 1,'message'=>trans('app.book_purchased'), 'link' => str_replace([" ","'"],["%20","%25E2%2580%2599"],asset('assets/pdf/'.env('PDF_NAME')))], 200);
            return response()->json(['status' => 1,'message'=>trans('app.book_purchased'), 'link' => (asset('assets/pdf/'.rawurlencode(env('PDF_NAME'))))], 200);
        } catch (\Exception $e) {
            return response()->json(['status'=>0,'message'=>$e->getMessage()],500);
        }
    }
    
}  