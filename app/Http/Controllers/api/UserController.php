<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use App\Address;
use App\History;
use App\MinimumCredit;
use App\Product;
use App\Rating;
use App\Review;
use App\Chapter;
use App\CompletedOrder;
use App\UserToken;
use App\OrderProduct;
use App\LoyaltyPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

if (!defined('BASE_URL_PROFILE')) define('BASE_URL_PROFILE',URL::to('/').'/images/profile_images/');

class UserController extends Controller
{
    public function notification( $body,$title,$device_token,$key,$user_id)
    {

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token = $device_token;
        $notification = [
            'title' => $title,
            'body' => $body,
            'sound' => true,
        ];
        // $extraNotificationData = ["key" => $key, "user_id" =>$user_id];
        $fcmNotification = [
            //'registration_ids' => $tokenList, //multiple token array
            'to' => $token, //single token
            'notification' => $notification,
            // 'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key= '.\App\Setting::first()->firebase_server_key,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return response()->json(['data' => 'notification sent', 'action' => $result], 200);
    }

    public function generate_uuid() {
        return sprintf( '%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );

    }

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'name'=>'required',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required',
                'phone'=>'required|unique:users',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'type' => 'required',
//                'boat_detail' => 'required',
//                'find_from' => 'required',
            ));

        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        } else {
            $request['password'] = bcrypt($request->password);
            //return $request->all();
            DB::beginTransaction();

            try {
                $user = User::create($request->all());
                $image = $request->image;
                $destination = 'images/profile_images';
                if ($request->hasFile('image')) {
                    $filename = strtolower(
                        pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                        . '-'
                        . uniqid()
                        . '.'
                        . $image->getClientOriginalExtension()
                    );
                    str_replace(" ", "-", $filename);
                    $image->move($destination, $filename);
                    $user->image = $filename;
                    $user->save();
                }
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return response()->json([
                    'message' => $exception->getMessage()
                ], 403);
            }
            //$data = 'Bearer' . ' ' . $user->createToken('MyApp')->accessToken;
            $response_array = array('user' =>$user ,'message' =>'Successfully Register!!' ,'status_code' => 200);
        }
        $response = response()->json($response_array, 200);
        return $response;
    }
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);

        }
        else {
            $user = User::where(function ($query) use ($request) {
                $query->where('email', $request->email)->first();
            })->first();

            if (!$user)
                return response()->json([
                    'message' => 'incorrect email',
                    'status'=>false
                ], 403);

            if (!auth()->loginUsingId((password_verify($request->password, $user->password)) ? $user->id : 0))
                return response()->json([
                    'message' => 'incorrect password',
                    'status'=>false
                ], 403);
            $user = auth()->user();
            $request['user_id'] = $user->id;
            $request['email']=$user->email;
            $request['phone']=$user->phone;
            $request['type']=$user->type;
            $data = 'Bearer' . ' ' . $user->createToken('MyApp')->accessToken;
            $response_array = array('user_id'=>$request->user_id,
                'email'=>$request->email, 'phone'=>$request->phone,'type'=>$request->type,
                'status' => true,'status_code'=>200,'message' => 'Logged in successfully', 'data'=>$data);
        }
        $response = response()->json($response_array, 200);
        return $response;
    }


    public function profile($user)
    {
        $getUser=User::select('id','name','email','image','phone','type')->where('id',$user)->first();
        return response()->json([
            'status' => true,
            'data' => $getUser,
            'BASE_URL_PROFILE'=>BASE_URL_PROFILE,
        ]);
    }
    public function updateProfile(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            array(
                'user_id'=>'required',
                'name'=>'nullable',
                'email' => 'required|email|max:255',
                'phone'=>'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg',
            ));
        $user=User::find($request->user_id);
        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }
        else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            //$user->image = $request->image;
            $user->save();

            if($image = $request->image=='')
            {
                $image = $user->image;
            }
            else{
                $image = $request->image;
            }
            $destination = 'images/profile_images';
            if ($request->hasFile('image')) {
                $filename = strtolower(
                    pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    . '-'
                    . uniqid()
                    . '.'
                    . $image->getClientOriginalExtension()
                );
                str_replace(" ", "-", $filename);
                $image->move($destination, $filename);
                $user->image = $filename;
                $user->save();
            }
            $response_array = array('status' => true, 'status_code' => 200, 'user'=>$user);
        }
        $response = response()->json($response_array, 200);
        return $response;
    }

    public function userDeviceToken(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
            'device_token' => 'required',
            'user_id' => 'required',
        ]);

        $driver =UserToken::updateOrCreate(
            ['user_id' => $request->user_id],
            ['device_tokens' => $request->device_token]
        );

        return response()->json([
            'status'=>true,
        ]);
    }
    public function forgotPassword(Request $request)
    {

        $validator = Validator::make(
            $request->all(), [
            'email' => 'required|email|exists:users',
        ]);

        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
            $response = response()->json($response_array, 201);
            return $response;
        }
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('mail.forgot_password_mail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        $response_array = array('message' => 'Mail send successfully!!', 'status_code' => 200);
        $response = response()->json($response_array, 200);

        return $response;

    }

    public function changepassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
            'email' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
            $response = response()->json($response_array, 201);
            return $response;
        } else {


            $check_password = User::where(['email' => $request->email])->first();
            $password = bcrypt($request->password);
            if ($check_password) {
                User::where('email', $request->email)->update(['password' => $password]);
                return response()->json([
                    'status' => true,
                    'message' => 'Password change Successfully'
                ]);
            } else {
                return response()->json([
                    'status' => false,

                ]);
            }

        }
    }
}

