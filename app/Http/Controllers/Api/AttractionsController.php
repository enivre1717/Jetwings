<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Attractions;

class AttractionsController extends \App\Http\Controllers\Controller
{
    
    public function getAttractions(){
        
        try{
            $statusCode = config("app.status_code.OK");
            
            $attractionsModel = new Attractions;
            
            $aryResponse = $attractionsModel->getAttractions();
            
            return response()->json($aryResponse, $statusCode);
            
        }catch(Exception $ex){
            $statusCode = config("app.status_code.Exception");
            
            return response()->json($ex->getMessage(), $statusCode);
        }
        
    }
}
