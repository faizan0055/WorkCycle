<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
date_default_timezone_set("Asia/Karachi");

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function pagination($data,$limit,Request $request,$url){
        
    // PAgination Start
            $totalCount = $data->count();
            
            $page = $request->input('page') ?:1;
            if ($page) {
                $skip = $limit * ($page - 1);
                $data = $data->take($limit)->skip($skip);
            } else {
                $data = $data->take($limit)->skip(0);
            }
            
            $parameters = $request->getQueryString();
            $parameters = preg_replace('/&page(=[^&]*)?|^page(=[^&]*)?&?/','', $parameters);
            $path = url('/') . '/api/'.$url.'?' . $parameters;
            
            $categories = $data->toArray();
            
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($categories, $totalCount, $limit, $page);
            $data = $paginator->withPath($path);
    // PAgination Ends
            return $data;
    }
}
