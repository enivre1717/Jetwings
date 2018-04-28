<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\InStore;
use Validator;

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
            
            $data = json_decode($request->getContent(), true);
            
            $validator = Validator::make($data["inStore"], [
                'representative' => 'required',
                'signature' => 'required',
                'tourLeaderSignature' => 'required',
                'addRemoveAttraction' => 'required',
            ],[
                "addRemoveAttraction.required" => "请选择其中一项!",
                "representative.required" => "团员代表不能为空!",
                "signature.required" => "签名不能为空!",
                "tourLeaderSignature.required" => "领队签名不能为空!",
                
            ]);
            
            if ($validator->fails()) {
                $aryErrors["errors"] = $validator->errors();
                
                $aryResponse = $aryErrors;
                
            }else{
                $inStoreModel = new InStore;
            
                $aryResponse = $inStoreModel->submitForm($data["inStore"]);
            }
            
        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}