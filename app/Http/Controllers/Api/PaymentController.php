<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\User;
use Validator;
use stdClass;
use Exception;

class PaymentController extends Controller
{   
    public function __construct(){
    }
    
    public function index(Request $request)
    {
        try{
            $data = PaymentTransaction::select('*')->with('services')->where('user_id','=', $request->user()->id)->get();
            // $data = PaymentTransaction::where('user_id','=', $request->user()->id)->select('*')->with(['services' => function ($query) {$query->select('id','service_name');}])->get();
            
            return response()->json(['status' => 1, 'message' => '', 'result' => $data], 200);

        } catch(Exception $e){
            return response()->json(['status'=>0,'message'=>$e->getMessage()],500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'transaction_token' => 'required',
            'service_id' => 'required',
            'amount' => 'required'
        ]);
            
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => 'Please fill the information properly'], 200);
        }
        try {
            $payment = new PaymentTransaction();
            $payment->user_id = $request->user()->id;
            $payment->transaction_id = $request->transaction_id;
            $payment->transaction_token = $request->transaction_token;
            $payment->service_id = $request->service_id;
            $payment->amount = (float)$request->amount;

            $payment = $payment->save();

            return response()->json(['status'=>1,'message'=>'Data inserted Successfully'],200);
                    
        } catch (\Exception $e) {
            return response()->json(['status'=>0,'message'=>$e->getMessage()],500);
        }
    }

    
}  