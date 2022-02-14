<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\ContactUs;
use App\User;
use Auth;
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


}
