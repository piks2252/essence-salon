<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreTableDetail;
use App\User;
use Validator;
use stdClass;
use Exception;

class StoreTableDetailController extends Controller
{   
    public function __construct(){
    }
    
    public function index(Request $request)
    {
        try{
            //------------ category name with id----------------------//
            // Non Negotiable Items - 1
            // His characteristics - 2
            // Physical Features - 3
            // Spiritual Features - 4
            // What kind of Relationship Do you want - 5

            
            $response_data = [];
            $result=[];
            $response_data['count'] =config('app.store_table_count_by_category');
            $tableDetails = StoreTableDetail::select('id','message','category_id')->where('user_id','=', $request->user()->id)->get();
            $tableDetails = $tableDetails->groupBy('category_id')->toArray();
            foreach ($tableDetails as $key => $value) {
                $object = new stdClass;
                $object->category_id = $key;
                $object->data = $value;
                array_push($result,$object);
            }
            $response_data['result'] = $result;
            $response_data['status'] = 1;
            return response()->json($response_data,200);

        } catch(Exception $e){
            return response()->json(['status'=>0,'message'=>$e->getMessage()],500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*.data.*.message' => 'required',
            '*.data.*.category_id' => 'required'
        ]);
            
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => 'Please fill the information properly'], 200);
        }
        try {
            foreach ($request->all() as $key => $value) {
                foreach ($value['data'] as $innerKey => $innerValue) {
                    if(array_key_exists('id', $innerValue) && $innerValue['id']!='' && $innerValue['id']!=null && $innerValue['id']!=0){
                        $tableDetails = StoreTableDetail::findOrFail($innerValue['id']);
                    } else{
                        $tableDetails = new StoreTableDetail();
                    }
                    $tableDetails->user_id = $request->user()->id;
                    $tableDetails->message = $innerValue['message'];
                    $tableDetails->category_id = $innerValue['category_id'];
                    $tableDetails->save();


                    // $innerValue['user_id'] = $request->user()->id;
                    // StoreTableDetail::updateOrCreate((array)$innerValue);
                }
            }

        return response()->json(['status'=>1,'message'=>'Data inserted Successfully'],200);            
        } catch (\Exception $e) {
            return response()->json(['status'=>0,'message'=>$e->getMessage()],500);
        }
    }
    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
            
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => 'Please fill the information properly'], 200);
        }
		try {
			$tableDetails = StoreTableDetail::findOrFail($request->id);
			$tableDetails->delete();
			return response()->json(['status'=>1,'message'=>'Data Deleted Successfully'],200);

		} catch (Exception $e) {
			return response()->json(['status'=>0,'message'=>$e->getMessage()],500);
		}
	}

    
}  