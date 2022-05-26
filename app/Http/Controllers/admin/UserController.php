<?php

namespace App\Http\Controllers\admin;

use App\AssignUser;
use App\Chapter;
use App\Country;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Image;
use File;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\WellComeMail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $users=User::where('type', '!=' ,'admin')->get();
        return view('admin.user.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Chapter::get();
        $countries=Country::get();
        return view('admin.user.create',compact('categories','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'country_id'=>'required',
            'password'=>'required|min:6',
            'email'=>'required|unique:users,email',
            'phone'=>'required|unique:users,phone',
            'image'=>'nullable|mimes:jpg,jpeg,png',

        ]);
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        if($user){

            Mail::to($user->email)
                ->cc($user->email)
                ->bcc($user->email)
                ->send(new WellComeMail($user));
            if (Mail::failures()) {
                Session::flash('success','Oops Something Went Wrong!');
            }
        Session::flash('success','Created Successfully!!');
        return redirect()->back();

        }
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/user_profile/'.$fileName;
                //Resize Image
                Image::make($image)->resize(128,128)->save($large_image_path);
                $user->image = $fileName;
                $user->save();

            }


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::findOrFail($id);
        return view('admin.user.balance',compact('user'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orders($id)
    {
        $user=User::findOrFail($id);
        return view('admin.user.orders',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'name'=>'required',
//            'email'=>'required|unique:users,email',
//            'phone'=>'required|string|max:11|unique:users',
            'image'=>'nullable|mimes:jpg,jpeg,png,svg',
        ]);
        //dd($request->all());

        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->update();
        $image_small=url('images/user_profile/',$user->image);
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/user_profile/'.$fileName;
                //Resize Image
                Image::make($image)->save($large_image_path);
                if(file_exists($image_small)){
                    unlink($image_small);
                }
                $user->image = $fileName;
                $user->save();
            }
        }
        //dd($user);
        $user->save();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }


    public function change_block_status(Request $request)
    {
        $user=User::findOrFail($request->id);
        if ($user->blocked)
            $user->blocked = false;
        else
            $user->blocked = true;

        $user->save();
        return redirect()->back();
    }
}
