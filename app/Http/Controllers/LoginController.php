<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AssignUser;
use App\Chapter;
use App\Mail\LoginAlertMail;
use App\RegisterLinks;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login_view()
    {
        if (auth()->check())
            return redirect('/');
        return view('auth.restaurant_login');
    }
    public function admin_login_view()
    {
        if (auth()->check())
            return redirect('/');
        return view('auth.admin_login');
    }
    public function merchant_login_view()
    {
        if (auth()->check())
            return redirect('/');
        return view('auth.merchant_login');
    }
    public function userLoginView()
    {
        if (auth()->check())
            return redirect('/');
        else
            return view('auth.user_login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:191',
        ]);
        $request->validate([
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:191',
        ]);
        if($user = User::where('email',$request->email)->where('type','client')->where('blocked','1')->first()){

            //if user not
            if (!$user) {
                $alert['type'] = 'danger';
                $alert['heading'] = 'login failed';
                $alert['message'] = 'Invalid Email or Password';
                return redirect()->back()->with('alert', $alert);
            }
            if (!auth()->loginUsingId((password_verify($request->password, $user->password)) ? $user->id : 0)) {
                $alert['type'] = 'danger';
                $alert['heading'] = 'login failed';
                $alert['message'] = 'Invalid  password';
                return redirect()->back()->with('alert', $alert);
            }
            //Send mail when user Login
            Mail::to($user->email)->send(new LoginAlertMail($user));
            if (auth()->check() and auth()->user()->type === 'client')
                return redirect('/client');

        }
        if($user = User::where('email',$request->email)->where('type','merchant')->where('blocked','1')->first()){
            if (!$user) {
                $alert['type'] = 'danger';
                $alert['heading'] = 'login failed';
                $alert['message'] = 'Invalid Email or Password';
                return redirect()->back()->with('alert', $alert);
            }
            if (!auth()->loginUsingId((password_verify($request->password, $user->password)) ? $user->id : 0)) {
                $alert['type'] = 'danger';
                $alert['heading'] = 'login failed';
                $alert['message'] = 'Invalid  password';
                return redirect()->back()->with('alert', $alert);
            }
            //Send mail when user Login
            Mail::to($user->email)->send(new LoginAlertMail($user));
            if (auth()->check() and auth()->user()->type === 'merchant')
                return redirect('/merchant');
        }
        if($user = User::where('email',$request->email)->where('type','admin')->where('blocked','1')->first()){
        if (!$user) {
            $alert['type'] = 'danger';
            $alert['heading'] = 'login failed';
            $alert['message'] = 'Invalid Email or Password';
            return redirect()->back()->with('alert', $alert);
        }
        if (!auth()->loginUsingId((password_verify($request->password, $user->password)) ? $user->id : 0)) {
            $alert['type'] = 'danger';
            $alert['heading'] = 'login failed';
            $alert['message'] = 'Invalid  password';
            return redirect()->back()->with('alert', $alert);
        }
        if (auth()->check() and auth()->user()->type === 'admin')
            return redirect('/admin');
        }
        else{
            if (!$user) {
                $alert['type'] = 'danger';
                $alert['heading'] = 'login failed';
                $alert['message'] = 'Login Failed Please Try Again letter';
                return redirect()->back()->with('alert', $alert);
            }
    }



    }
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:191',
        ]);
        if($user = User::where('email',$request->email)->where('type','client')->where('blocked','1')->first()){
        if (!$user) {
            $alert['type'] = 'danger';
            $alert['heading'] = 'login failed';
            $alert['message'] = 'Invalid Email or Password';
            return redirect()->back()->with('alert', $alert);
        }
        if (!auth()->loginUsingId((password_verify($request->password, $user->password)) ? $user->id : 0)) {
            $alert['type'] = 'danger';
            $alert['heading'] = 'login failed';
            $alert['message'] = 'Invalid  password';
            return redirect()->back()->with('alert', $alert);
        }
        if (auth()->check() and auth()->user()->type === 'client')
            return redirect('/client');
        }
        if($user = User::where('email',$request->email)->where('type','merchant')->where('blocked','1')->first()){
            if (!$user) {
                $alert['type'] = 'danger';
                $alert['heading'] = 'login failed';
                $alert['message'] = 'Invalid Email or Password';
                return redirect()->back()->with('alert', $alert);
            }
            if (!auth()->loginUsingId((password_verify($request->password, $user->password)) ? $user->id : 0)) {
                $alert['type'] = 'danger';
                $alert['heading'] = 'login failed';
                $alert['message'] = 'Invalid  password';
                return redirect()->back()->with('alert', $alert);
            }
            if (auth()->check() and auth()->user()->type === 'merchant')
                return redirect('/merchant');
            }
    }

    public function logout()
    {

        if (auth()->check()){
        if(auth()->user()->type === 'admin'){
            auth()->logout();
            return redirect('/');
        }
        elseif(auth()->user()->type === 'client'){
            auth()->logout();
            return redirect('/');
        }
        elseif(auth()->user()->type === 'merchant'){
            auth()->logout();
            return redirect('/');
        }
    }
    else{
       return redirect('/');
    }
    }

}
