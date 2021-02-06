<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use App\Models\DeviceToken;
use JWTAuthException;
use Validator;
use Exception;
use Password;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{   
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
    
    public function register(Request $request){
        // condition is user login with social login and already exist
        if(($request->get('provider')!= null && $request->get('provider')!= '' && $request->get('provider') != 'local') && ($request->get('provider_id')!= null && $request->get('provider_id')!= '') && User::where('provider_id', '=', $request->get('provider_id'))->where('provider', '=', $request->get('provider'))->exists()){
            $user_data =  User::where('provider_id', '=', $request->get('provider_id'))->where('provider', '=', $request->get('provider'))->first();
            // add device id in deviceToken table
            if(($request->get('device_id') != '' && $request->get('device_id') != null) && !DeviceToken::where('device_token','=',$request->get('device_id'))->where('user_id','=',$user_data->id)->exists() ){
                $update_device_id = new DeviceToken();
                $update_device_id->user_id = $user_data->id;
                $update_device_id->device_token = $request->get('device_id');
                $update_device_id->save();
            }

            if ($token = JWTAuth::fromUser($user_data)) {
                if (!filter_var($user_data->profile_img, FILTER_VALIDATE_URL)) {
                    $user_data->profile_img =  asset('assets/images/profiles/' .$user_data->profile_img);
                }
                return response()->json(['status' => 1, 'token' => $token, 'result' => $user_data, 'message' => trans('app.login_success')],200);
            }
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            // 'profile_img' => 'max:4000'
		]);

		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => 'Please fill the information properly'], 200);
		}
        try{
            
            if (User::where('email', '=', $request->get('email'))->exists()) {
                return response()->json(['status'=>0,'message'=>'Email is already registered'],200);
            }
                $user = $this->user->create([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'gender' => $request->get('gender'),
                    'date_of_birth' => $request->get('date_of_birth'),
                    'password' => bcrypt($request->get('password')),
                    'provider' => $request->get('provider'),
                    'provider_id' => $request->get('provider_id'),
                    'profile_img' => ($request->get('profile_img')) ? $request->get('profile_img') : 'default.png',
                    
                ]);
                // call the setAffirmationId function to insert quote id and image id in user table
                app(\App\Http\Controllers\Api\AffirmationQuoteController::class)->setAffirmationId($user,'all');

                // condition is NEW user login with social login
                if(($request->get('provider')!= null && $request->get('provider')!= '' && $request->get('provider') != 'local') && ($request->get('provider_id')!= null && $request->get('provider_id')!= '')){
                if ($token = JWTAuth::fromUser($user)) {
                    return response()->json(['status' => 1, 'token' => $token, 'result' => $user, 'message' => trans('app.login_success')],200);
                }
            }
                return response()->json(['status'=>1,'message'=>'User created successfully']);
            
        } catch(Exception $e){
            return response()->json(['status'=>0,'message'=>$e->getMessage()],500);
        }
    }
    
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => 'Please fill the information properly'], 200);
		}
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['status' => 0, 'message'=>trans('app.invalid_email_or_password')], 200);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['status' => 0, 'message'=>trans('app.failed_to_create_token')], 500);
        }
        if($request->user()->status == 0){
            return response()->json(['status' => 0, 'token' => '', 'result' => '', 'message' => trans('app.account_deactivated')],200);
        }
        // add device id in deviceToken table
        if(($request->get('device_id') != '' && $request->get('device_id') != null) && !DeviceToken::where('device_token','=',$request->get('device_id'))->where('user_id','=',$request->user()->id)->exists() ){
            $update_device_id = new DeviceToken();
            $update_device_id->user_id = $request->user()->id;
            $update_device_id->device_token = $request->get('device_id');
            $update_device_id->save();
        }

        $request->user()->profile_img = asset('assets/images/profiles/' .$request->user()->profile_img);
        
        return response()->json(['status' => 1, 'token' => $token, 'result' => $request->user(), 'message' => trans('app.login_success')],200);
    }
    public function logout(Request $request) 
    {
        // Get JWT Token from the request header key "Authorization"
        $token = $request->header('Authorization');
        // Invalidate the token
        try {
            // remove device token from deviceToken table
            if(($request->get('device_id') != '' && $request->get('device_id') != null) && DeviceToken::where('device_token','=',$request->get('device_id'))->exists() ){
                $user_device_id = DeviceToken::where('device_token','=',$request->get('device_id'))->where('user_id','=',$request->user()->id)->delete();
            }
            JWTAuth::invalidate($token);
            return response()->json([
                'status' => 1, 
                'message'=> "User successfully logged out."
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
              'status' => 0, 
              'message' => 'Failed to logout, please try again.'
            ], 500);
        }
    }
    public function getAuthUser(Request $request){
        
        return response()->json(['result' => $request->user()], 200);
        
    }
    public function updateProfile(Request $request)
    {
       $validator = Validator::make($request->all(), [
			'name' => 'required',
			'gender' => 'required',
			'date_of_birth' => 'required',
			// 'profile_img' => 'max:1000'
		]);

		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => 'Please fill the information properly'], 200);
		}
		try
		{
            $user_data = User::findorFail($request->user()->id);
            $user_data->name = $request->name;
            $user_data->gender = ((int)$request->gender == 0 || (int)$request->gender == 1) ? (int)$request->gender : null;
            $user_data->date_of_birth = $request->date_of_birth;
            if ($request->profile_img != "" && $request->profile_img != null) {
                // dd($request->profile_img);
                $image = $request->file('profile_img');
                $fileName = 'Img-' . date('YmdHsi') . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path() . '/assets/images/profiles/';
                $image->move($destinationPath, $fileName);
                chmod($destinationPath . "/" . $fileName, 0777); 
                if ($user_data->profile_img != 'default.png' && !filter_var($user_data->profile_img, FILTER_VALIDATE_URL)) {
                    if ($user_data->profile_img != null && file_exists(public_path() . '/assets/images/profiles/' . $user_data->profile_img)) {
                        unlink(public_path() . '/assets/images/profiles/' . $user_data->profile_img);
                    }
                }
                $user_data->profile_img = $fileName;
            }
            
            $user_data->save();

            if(!filter_var($user_data->profile_img, FILTER_VALIDATE_URL)){
                $user_data->profile_img =  asset('assets/images/profiles/' .$user_data->profile_img);
            }
			return response()->json(['status' => 1, 'message' => 'Profile updated successfully!', 'result' => $user_data], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 500);
        }
    }

    // api for change password
	public function changePassword(Request $request) {
		$validator = Validator::make($request->all(), [
			'old_password' => 'required',
			'new_password' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => 'Please fill the information properly'], 200);
		}
		try
		{
			$user = $request->user()->id;
			$user_data = User::findorFail($user);

			if (Hash::check($request->old_password, $user_data->password)) {
				User::where('id', $user)->update([
					'password' => bcrypt(str_replace(' ', '', $request->new_password)),
				]);
				return response()->json(['status' => 1, 'message' => 'Password changed successfully!'], 200);
			} else {
				return response()->json(['status' => 0, 'message' => 'Please enter valid old password'], 200);
			}

		} catch (\Exception $e) {
			return response()->json(['status' => 0, 'message' => $e->getMessage()], 500);
		}
    }
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'email' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => trans('app.please_fill_the_information_properly')], 200);
		}
        try {
            $user = User::where('email', $request->input('email'))->first();
			if (!empty($user)) {
				if ($user->status == 0) {
					return response()->json(['status' => 0, 'message' => trans('app.account_deactivated')]);
				} else {
					$response = Password::sendResetLink(["email" => $request->input('email')]);

					if (Password::RESET_LINK_SENT == $response) {
						return response()->json(['status' => 1, 'message' => trans($response)]);
					} else {
						return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong')]);
					}
				}
			} else {
				return response()->json(['status' => 0, 'message' => trans('passwords.user')]);
			}
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 500);
        }
    }

    // api for change notification type(one day, alternate day, once in a week)
    public function changeNotificationType(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'notification_type' => 'required|integer|between:1,3',
		]);
		if ($validator->fails()) {
			return response()->json(['status' => 0, 'message' => 'Please fill the information properly'], 200);
		}
        try {
            $user_data = User::findOrFail($request->user()->id);
            $user_data->notification_type = $request->notification_type;
            $user_data->save();
            return response()->json(['status' => 1, 'message' => 'Notification updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 500);
        }
    }
    
}  