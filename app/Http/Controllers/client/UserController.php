<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\ContactUs;
use App\User;
use App\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
//    public function profile()
//    {
//        $restaurant = auth()->user()->restaurant;
//        return view('client.profile',compact('restaurant'));
//    }
    public function edit_profile(User $user){
        return view('client.edit_profile',compact('user'));
    }
    public function transactions(User $user){
        $transactions=ContactUs::where('user_id',auth()->user()->id)->get();
        return view('client.histories.index',compact('transactions'));
    }
//    public function profile_update(Request $request)
//    {
//        // dd($request->all());
//        $request->validate([
//            'name' => 'required|string|max:191',
//            'slogan' => 'required|string|max:191',
//            'logo' => 'nullable|image|mimes:jpeg,png,jpg',
//            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg',
//            'city' => 'required|string|max:191',
//            'address' => 'required|string|max:191',
//            'latitude' => 'required',
//            'longitude' => 'required',
//            'description' => 'required|string|max:191',
//            'min_order' => 'nullable|integer',
//            'avg_delivery_time' => 'nullable|integer',
//            'avg_pickup_time' => 'nullable|integer',
//            // 'delivery_range' => 'nullable|integer',
//            'admin_commission' => 'required|integer'
//        ]);
//        // if($client->)
//        $restaurant = Restaurant::where('id',$request->id)->first();
//        User::find($restaurant->user_id)->update(['name'=>$request->name]);
//        if ($request->cuisine_id)
//            $restaurant->cuisines()->sync($request->cuisine_id);
//        $restaurant->update($request->all());
//        $cover_image = $request->cover_image;
//        $logo=$request->logo;
//        $destination = 'images/restaurant_images';
//        if ($request->hasFile('cover_image')) {
//            $filename = strtolower(
//                pathinfo($cover_image->getClientOriginalName(), PATHINFO_FILENAME)
//                . '-'
//                . uniqid()
//                . '.'
//                . $cover_image->getClientOriginalExtension()
//            );
//            $cover_image->move($destination, $filename);
//            str_replace(" ", "-", $filename);
//            $restaurant->cover_image = $filename;
//            $restaurant->update();
//        }
//        if ($request->hasFile('logo')) {
//            $file = strtolower(
//                pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME)
//                . '-'
//                . uniqid()
//                . '.'
//                . $logo->getClientOriginalExtension()
//            );
//            $logo->move($destination, $file);
//            str_replace(" ", "-", $file);
//            $restaurant->logo = $file;
//            $restaurant->update();
//        }
//        $alert['type'] = 'success';
//        $alert['message'] = 'Profile Updated Successfully';
//        return redirect()->route('client.profile')->with('alert', $alert);
//
//    }
    public function passwordUpdate(Request $request)
    {
        $error=$request->validate([
            'current_password'=>'required',
            'password' => 'required|confirmed',
        ]);
        //dd($error);
        $data = $request->all();
        $current_password = $data['current_password'];
        $check_password = User::find(auth()->user()->id);
        if (Hash::check($current_password, $check_password->password)) {
            $password = bcrypt($data['password']);
            $check_password->update(['password' => $password]);
            Session::flash('success','Password Updated Successfully!!');
            return redirect()->back();
            } else {
            Session::flash('error','Incorrect Current Password!!');
            return redirect()->back();
            }
        return redirect()->back();
    }
    public function profile()
    {
        $admin=User::where('type','client')->first();
        return view('client.profile')->with('admin',$admin);
    }
    public function profile_update(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name'=>'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);
        $admin=User::where('type','client')->first();
        if ($request->phone)
            if ($request->phone != $admin->phone) {
                $request->validate([
                    'phone' => 'required|string|max:191|unique:users',
                ]);
            } else
                $request->request->remove('phone');
        // if ($request->old_password)
        //     if (password_verify($request->old_password, $admin->password)) {
        //         $request->validate([
        //             'password' => 'required|string|min:6|max:191'
        //         ]);
        //         $request['password'] = bcrypt($request->password);
        //     } else
        //         $request->request->remove('password');
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
        $alert['type'] = 'success';
        $alert['message'] = 'Profile updated Successfully';
        return redirect()->back()->with('alert', $alert);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $countries=Country::get();
        return view('admin.user.edit',compact('user','countries'));
    }
}
