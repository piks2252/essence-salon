<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Audio;
use Exception;
use stdClass;

class AudioController extends Controller
{   
    public function __construct(){
    }
    
    public function index(Request $request)
    {
        try {
            // audio category with name

            // 1 = Single Moms Audio
            // 2 = Men Audio
            // 3 = Women Audio
            // 4 = Teen Audio
            // 5 = Meditations
            $audios = Audio::select('*')->get();
            $result=[];
            if(count($audios) > 0){
                $audios = $audios->groupBy('category_id');
                foreach ($audios as $key => $value) {
                    $object = new stdClass;
                    $object->category_id = $key;
                    $object->audios = $value;
                    array_push($result,$object);
                }
                return response()->json(['status' => 1, 'message' => '', 'result' => $result], 200);
            }
            return response()->json(['status' => 1, 'message' => trans('app.no_audio')], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 500);
        }
    }

    
}  