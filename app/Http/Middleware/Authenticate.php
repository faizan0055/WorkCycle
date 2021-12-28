<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            //dd($request->getRequestUri());
            if($request->getRequestUri()==="/admin"){
                return url('/');
            }
            elseif($request->getRequestUri()==="/client"){
                return url('/');
            }
            elseif($request->getRequestUri()==="/merchant"){
                return url('/merchant/login');
            }
        }
    }
}
