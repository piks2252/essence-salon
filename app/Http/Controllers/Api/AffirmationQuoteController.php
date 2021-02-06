<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AffirmationQuotes;
use App\Models\AffirmationImages;
use App\User;
use Validator;
use Exception;

class AffirmationQuoteController extends Controller
{   
    public function __construct(){
    }
    
    public function getAffirmationQuote(Request $request)
    {
        try{
            $response_data = [];
            $quote_msg = AffirmationQuotes::select('*')->where('id','=', $request->user()->read_affirmation_quote_id)->first();
            $quote_img = AffirmationImages::select('*')->where('id','=', $request->user()->read_affirmation_image_id)->first();
            if(!empty($quote_msg)){
                $response_data['quote_message'] = $quote_msg->message;
            } else{
                $this->setAffirmationId($request->user(),'msg');
                $affirmation_id = User::select('read_affirmation_quote_id')->where('id', '=', $request->user()->id)->first()->read_affirmation_quote_id;
                $quote_msg = AffirmationQuotes::select('*')->where('id','=',$affirmation_id)->first();
                $response_data['quote_message'] = $quote_msg->message;
            }

            if(!empty($quote_img)){
                $response_data['quote_image'] = ($quote_img->image_path) ? asset('assets/images/affirmation-images/'.$quote_img->image_path) : $quote_img->image_path;
            } else{
                $this->setAffirmationId($request->user(),'img');
                $affirmation_image_id = User::select('read_affirmation_image_id')->where('id', '=', $request->user()->id)->first()->read_affirmation_image_id;
                $quote_img = AffirmationImages::select('*')->where('id','=',$affirmation_image_id)->first();
                $response_data['quote_image'] = ($quote_img->image_path) ? asset('assets/images/affirmation-images/'.$quote_img->image_path) : $quote_img->image_path;
            }
            $response_data['status'] = 1;
            return response()->json($response_data,200);

        } catch(Exception $e){
            return response()->json(['status'=>0,'message'=>$e->getMessage()],500);
        }
    }
    public function setAffirmationId($request,$request_type)
    {
        // dd($request->read_affirmation_quote_id);
        $user = User::findOrFail($request->id);
        if($request_type == 'msg' || $request_type == 'all'){
            if(($request->read_affirmation_quote_id == null)){
                if(AffirmationQuotes::first()){
                    $user->read_affirmation_quote_id = AffirmationQuotes::first()->id;
                    
                }
            } else{
                $user_read_quote_id = $request->read_affirmation_quote_id+1;
                if(AffirmationQuotes::where('id', '=', $user_read_quote_id)->exists()){
                    
                    $user->read_affirmation_quote_id =$user_read_quote_id;
                    
                } else{
                    if(AffirmationQuotes::where('id', '>', $user_read_quote_id)->exists()){
                        
                        $user->read_affirmation_quote_id =AffirmationQuotes::where('id', '>', $user_read_quote_id)->first()->id;
                         
                    } else{
                        
                        $user->read_affirmation_quote_id = AffirmationQuotes::first()->id;
                    }
                }
            }
        }

        if($request_type == 'img' || $request_type == 'all'){
            if(($request->read_affirmation_image_id == null)){
                if(AffirmationImages::first()){
                    $user->read_affirmation_image_id = AffirmationImages::first()->id;
                    
                }
            } else{
                $user_read_image_id = $request->read_affirmation_image_id+1;
                if(AffirmationImages::where('id', '=', $user_read_image_id)->exists()){
                    
                    $user->read_affirmation_image_id =$user_read_image_id;
                    
                } else{
                    if(AffirmationImages::where('id', '>', $user_read_image_id)->exists()){
                        
                        $user->read_affirmation_image_id =AffirmationImages::where('id', '>', $user_read_image_id)->first()->id;
                        
                    } else{
                        
                        $user->read_affirmation_image_id = AffirmationImages::first()->id;
                    }
                }
            }
        }
        $user->save();
        // return $user;
        
    }
    public function setAffirmationIdCron()
    {
        $users = User::select('*')->get();
        if(count($users) > 0){
            foreach ($users as $key => $user) {
                $this->setAffirmationId($user,'all');
                User::sendPushNotification($user->id);
            }
        }
        return "true";
    }

    
}  