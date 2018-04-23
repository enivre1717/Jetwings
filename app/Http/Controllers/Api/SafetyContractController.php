<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\SafetyContracts;

class SafetyContractController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /* Submit Safety Contract Form
     * 
     * @params POST data
     * @return json
     */
    public function submitForm(Request $request){
        
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'nric' => 'required',
                'signature' => 'required',
            ],[
                "name.required" => "名字不能为空!",
                "nric.required" => "护照号码不能为空!",
                "signature.required" => "签名不能为空!"
            ]);
            
            if ($validator->fails()) {
                $aryErrors["errors"] = $validator->errors();
                
                $aryResponse = $aryErrors;
                
            }else{
                $safetyContractModel=new SafetyContracts;

                $aryResponse = $safetyContractModel->submitForm($request->input("contract"));
            }

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
