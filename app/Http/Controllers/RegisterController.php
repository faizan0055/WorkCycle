<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('auth.register',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'type'=>'required',
            //'country_id'=>'required',
            'password'=>'required|min:6',
            'email'=>'required|unique:users,email',
            'phone'=>'required|unique:users,phone',
            'image'=>'nullable',

        ]);

        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
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
            str_replace(" ", "-", $filename);
            $image->move($destination, $filename);
            $user->image = $filename;
            $user->save();
        }
        // if($request->file('image')){
        //     $image=$request->file('image');
        //     if($image->isValid()){
        //         $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
        //         $large_image_path='public/images/user_profile/'.$fileName;
        //         //Resize Image
        //         Image::make($image)->resize(128,128)->save($large_image_path);
        //         $user->image = $fileName;
        //         $user->save();

        //     }
        // }
        //Session::flash('success','Created Successfully!!');
        return view('auth.login');
        // return redirect()->route('auth.login');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.show_profile',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
