<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        if (!auth()->check())
            return redirect('client/login');
        elseif ( auth()->user()->type === 'admin')
            return redirect('admin');
        else if (auth()->user()->type === 'client')
            return redirect('client');
        else if (auth()->user()->type === 'drivers')
            return redirect('restaurants/drivers');
        else
            return redirect('admin/login');
    }
}
