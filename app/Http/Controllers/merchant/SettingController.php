<?php

namespace App\Http\Controllers\merchant;
use App\Driver;
use app\Help;
use App\Http\Controllers\Controller;
use App\Ticket;
use Illuminate\Support\Facades\File;
use Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('drivers.settings.basic');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drivers.settings.documents');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         if ($request->email)
             if ($request->email != auth()->user()->email) {
                 $request->validate([
                     'email' => 'required|string|max:191|unique:users',
                 ]);
             }
         else
                 $request['email']= auth()->user()->email;

        if ($request->phone)
            if ($request->phone != auth()->user()->phone) {
                $request->validate([
                    'phone' => 'required|string|max:191|unique:users',
                ]);
            }
        else
            $request['phone']= auth()->user()->phone;
           // dd($request->all());
        User::find(auth()->user()->id)->update(['name'=>$request->name, 'email' => $request->email, 'phone'=>$request->phone]);
        auth()->user()->drivers->update($request->all());
        $image_small='images/driver/profile/'.auth()->user()->drivers->image;
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/driver/profile/'.$fileName;
                //Resize Image
                Image::make($image)->resize(250,250)->save($large_image_path);
                if($fileName!='' || $fileName!=null){
                    auth()->user()->drivers->image = $fileName;
                    if (file_exists($image_small)){

                        unlink($image_small);
                    }
                    auth()->user()->drivers->save();
                }
                else{
                    auth()->user()->drivers->image = $addon->image;
                    auth()->user()->drivers->save();
                }
                auth()->user()->drivers->image = $fileName;
                auth()->user()->drivers->save();
            }
        }
        Session::flash('success','Updated Successfully!!');
        return redirect()->back();
    }



    public function updateDocuments(Request $request)
    {
        //dd($request->all());
        $driver = Driver::where('user_id', auth()->user()->id)->first();
        $driver->update(['licence_no' => $request->licence_no, 'licence_expr' => $request->licence_expr, 'driving_id_expr' => $request->driving_id_expr]);
        $idcard_image = 'images/driver/card/' . $driver->idcard_image;
        if ($request->file('idcard_image')) {
            $image = $request->file('idcard_image');
            //dd($image);
            if ($image->isValid()) {
                $fileName = time() . '-' . Str::slug(auth()->user()->name, '-') . '.' . $image->getClientOriginalExtension();
                $large_image_path = 'images/driver/card/' . $fileName;
                //Resize Image
                Image::make($image)->resize(1000, 800)->save($large_image_path);
                if ($fileName != '' || $fileName != null) {
                    auth()->user()->drivers->idcard_image = $fileName;
                    if (file_exists($idcard_image)) {

                        unlink($idcard_image);
                    }
                    auth()->user()->drivers->save();
                } else {
                    auth()->user()->drivers->idcard_image = auth()->user()->drivers->idcard_image;
                    auth()->user()->drivers->save();
                }
                auth()->user()->drivers->idcard_image = $fileName;
                auth()->user()->drivers->save();
            }
        }

        ///Licence image
        $licence_image = 'images/driver/licence/' . $driver->licence_image;
        //dd($licence_image);
        if ($request->file('licence_image')) {
            $image = $request->file('licence_image');
            if ($image->isValid()) {
                $fileName = time() . '-' . Str::slug(auth()->user()->name, '-') . '.' . $image->getClientOriginalExtension();
                $large_image_path = 'images/driver/licence/' . $fileName;
                //Resize Image
                Image::make($image)->resize(1000, 800)->save($large_image_path);
                if ($driver->licence_image == null && $driver->licence_image == '') {
                    $driver->licence_image = $fileName;
                    $driver->save();
                } elseif (file_exists($licence_image)) {
                    unlink($licence_image);
                    $driver->licence_image = $fileName;
                    $driver->save();
                } else {
                    $driver->licence_image = $driver->licence_image;
                    $driver->save();
                }
            }
        }

        ///Vehicle front image
        $vehicle_front_image = 'images/driver/vehicle/' . $driver->vehicle_front_image;
        if ($request->file('vehicle_front_image')) {
            $image = $request->file('vehicle_front_image');
            if ($image->isValid()) {
                $frontName = time() . '-' . Str::slug(auth()->user()->name, '-') . '.' . $image->getClientOriginalExtension();
                $large_image_path = 'images/driver/vehicle/' . $frontName;
                //Resize Image
                //dd($frontName);
                Image::make($image)->resize(1000, 800)->save($large_image_path);
                if ($frontName) {
                    if (is_file($vehicle_front_image)) {
                        unlink($vehicle_front_image);
                    }
                    $driver->vehicle_front_image = $frontName;
                    $driver->save();
                } else {
                    $driver->vehicle_front_image = $driver->vehicle_front_image;
                    $driver->save();
                }
            }
        }

        ///Vehicle Back image
        $vehicle_back_image = 'images/driver/vehicle/' . $driver->vehicle_back_image;
        if ($request->file('vehicle_back_image')) {
            $image = $request->file('vehicle_back_image');
            if ($image->isValid()) {
                $backName = time() . '-' . Str::slug(auth()->user()->name, '-') . '.' . $image->getClientOriginalExtension();
                $large_image_path = 'images/driver/vehicle/' . $backName;
                //Resize Image
                //dd($frontName);
                Image::make($image)->resize(1000, 800)->save($large_image_path);
                if ($backName) {
                    if (is_file($vehicle_back_image)) {
                        unlink($vehicle_back_image);
                    }
                    $driver->vehicle_back_image = $backName;
                    $driver->save();
                } else {
                    $driver->vehicle_back_image = $driver->vehicle_back_image;
                    $driver->save();
                }
            }
        }

            ///Driver ID image
            $driver_id_image = 'images/driver/' . $driver->driver_id_image;
            if ($request->file('driver_id_image')) {
                $image = $request->file('driver_id_image');
                if ($image->isValid()) {
                    $backName = time() . '-' . Str::slug(auth()->user()->name, '-') . '.' . $image->getClientOriginalExtension();
                    $large_image_path = 'images/driver/' . $backName;
                    //Resize Image
                    Image::make($image)->resize(1000, 800)->save($large_image_path);
                    if ($backName) {
                        if (is_file($driver_id_image)) {
                            unlink($driver_id_image);
                        }
                        $driver->driver_id_image = $backName;
                        $driver->save();
                    } else {
                        $driver->driver_id_image = $driver->driver_id_image;
                        $driver->save();
                    }
                }

            }

        Session::flash('success', 'Updated Successfully!!');
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function helpTrash($id)
    {
        $ticket=Ticket::findOrFail($id);
        if($ticket){
            Session::flash('success','Successfully Updated!');
            return redirect()->back();
        }
    }
}
