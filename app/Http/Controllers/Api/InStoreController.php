<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\InStore;

class InStoreController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function submitForm(Request $request){
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $inStoreModel = new InStore;
            
            $aryResponse = $inStoreModel->submitForm($request->input("inStore"));

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}