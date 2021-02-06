<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Exception;

class VideoController extends Controller
{   
    public function __construct(){
    }
    
    public function index(Request $request)
    {
        try {
            //code...
            $videos = Video::select('*')->get();
            if(count($videos) > 0){
                return response()->json(['status' => 1, 'message' => '', 'result' => $videos], 200);
            }
            return response()->json(['status' => 0, 'message' => trans('app.no_video')], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 500);
        }
    }
}  