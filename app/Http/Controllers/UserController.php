<?php

namespace App\Http\Controllers;
use App\Country;
use App\User;
use App\History;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Illuminate\Support\Facades\Session;
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

    public function profile1()
    {
        $admin=User::find(auth::user()->id);
        return view('profile')->with('admin',$admin);


    }
    public function profile_update(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name'=>'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);
        $admin=User::find(auth::user()->id);
        if ($request->phone)
            if ($request->phone != $admin->phone) {
                $request->validate([
                    'phone' => 'required|string|max:191|unique:users',
                ]);
            } else
                $request->request->remove('phone');
        if ($request->old_password)
            if (password_verify($request->old_password, $admin->password)) {
                $request->validate([
                    'password' => 'required|string|min:6|max:191'
                ]);
                $request['password'] = bcrypt($request->password);
            } else
                $request->request->remove('password');
        $admin->update($request->all());
        $image = $request->image;
        $destination = 'images/user_profile';
        if ($request->hasFile('image')) {
            $filename = strtolower(
                pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                . '-'
                . uniqid()
                . '.'
                . $image->getClientOriginalExtension()
            );
            $image->move($destination, $filename);
            str_replace(" ", "-", $filename);
            $admin->image = $filename;
            $admin->update();
        }
//        $alert['type'] = 'success';
//        $alert['message'] = 'Profile updated Successfully';
//        return redirect()->back()->with('alert', $alert);
        Session::flash('success',' Profile Updated Successfully!!');
        return redirect()->back();
    }
    public function updatePwd(Request $request){

        $data=$request->all();
        $current_password=$data['pwd_current'];
        $email_login=Auth::user()->email;
        $check_password=User::where(['email'=>$email_login])->first();
        if(\Illuminate\Support\Facades\Hash::check($current_password,$check_password->password)){
            $password=bcrypt($data['pwd_new']);
            User::where('email',$email_login)->update(['password'=>$password]);
            Session::flash('success','Password Update Successfully !');
            return redirect()->back();
        }else{
            Session::flash('error','InCorrect Current Password!');
            return redirect()->back();
        }
    }
    public function changepass(){

        return view('change_pass');
    }


}
