<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Route;

use App\Http\Requests;
use App\Http\Helper\CurlHelper;

class ApiController extends \App\Http\Controllers\Controller
{
    
    public function post(Request $request){
        
        try{
            $url = config("app.api_url.".Route::currentRouteName());
            
            return CurlHelper::post($url, $request->all(), $request->header('Authorization'));
            
        }catch(Exception $ex){
            
            $statusCode = config("app.status_code.Exception");
            
            return response()->json($ex->getMessage(), $statusCode);
        }
        
    }
    
    public function get(Request $request, $id = 0){
        
        try{
            
            $url = config("app.api_url.".Route::currentRouteName());
            
            if(!empty($id)){
                $url = str_replace("{id}", $id, $url);
            }
            
            return CurlHelper::get($url, $request->header('Authorization'));
            
        }catch(Exception $ex){
            
            $statusCode = config("app.status_code.Exception");
            
            return response()->json($ex->getMessage(), $statusCode);
        }
        
    }
    
}
