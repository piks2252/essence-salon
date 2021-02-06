<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Exception;

class ServiceController extends Controller
{   
    public function __construct(){
    }
    
    public function index(Request $request)
    {
        try {
            //code...
            $services = Service::select('id','service_name','price')->get();
            if(count($services) > 0){
                return response()->json(['status' => 1, 'message' => '', 'result' => $services], 200);
            }
            return response()->json(['status' => 1, 'message' => trans('app.no_service')], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 500);
        }
    }

    
}  