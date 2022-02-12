<?php

namespace App\Http\Controllers;
use App\Country;
use App\User;
use App\History;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateInfo(Request $request, $id)
    {
        $user=User::find($id);
        $user->name = $request->fullname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();
        $users=User::find($id);
       return response()->json([
          'data' => $users,
           'message' => 'Profile updated Successfully!'
      ]);
    }
    public function profile(){

        if(auth()->check()){

            return view('frontend.user.my_profile');
        }
        else{
            return view('login');
        }

    }
    public function accountSettings(){

        if(auth()->check()){

            return view('frontend.user.settings');
        }
        else{
            return view('login');
        }

    }


    public function passwordUpdate(Request $request, $id)
    {

        $request->validate([
            'current_password'=>'required',
            'new_password' => 'required',
        ]);
        $validator = Validator::make(
            $request->all(),
            array(
                'name'=>'nullable',
                'email' => 'required|email|max:255|unique:users',
                // 'password' => 'required',
                'phone'=>'required|unique:users',
                'image' => 'nullable|image|mimes:jpeg,png,jpg',
                'type' => 'nullable|in:user,admin','client',
                'device_token' => 'required',
            ));

        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        } else {
            $data = $request->all();
            $current_password = $data['current_password'];

            $check_password = User::find($id);
            if (Hash::check($current_password, $check_password->password)) {
                $password = bcrypt($data['new_password']);
                User::where('id', $id)->update(['password' => $password]);
                $response_array = array('status' => true, 'title' => 'Good Job!!', 'icon' => 'success', 'message' => 'Profile Updated Successfully!!' ,'status_code' => 200);

            } else {
                $response_array = array('status' => true, 'title' => 'Oops!!', 'icon' => 'error', 'message' => 'Someting went wrong!!' ,'status_code' => 200);
            }

        }
        $response = response()->json($response_array, 200);
        return $response;

    }


}
