<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Restaurants;

class RestaurantsController extends \App\Http\Controllers\Controller
{
    
    public function getRestaurants(){
        
        try{
            $statusCode = config("app.status_code.OK");
            
            $restaurantsModel = new Restaurants;
            
            $aryResponse = $restaurantsModel->getRestaurants();
            
            return response()->json($aryResponse, $statusCode);
            
        }catch(Exception $ex){
            $statusCode = config("app.status_code.Exception");
            
            return response()->json($ex->getMessage(), $statusCode);
        }
        
    }
}
