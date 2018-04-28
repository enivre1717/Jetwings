<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\OwnExpenses;
use Validator;

class OwnExpensesController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /* Submit Own Expenses Form
     * 
     * @params POST data
     * @return json
     */
    public function submitForm(Request $request){
        
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $data = json_decode($request->getContent(), true);
            
            $validator = Validator::make($data["ownExpenses"], [
                'representative' => 'required',
                'signature' => 'required',
                'tourLeaderSignature' => 'required',
            ],[
                "representative.required" => "团员代表不能为空!",
                "signature.required" => "签名不能为空!",
                "tourLeaderSignature.required" => "领队签名不能为空!",
                
            ]);
            
            if ($validator->fails()) {
                $aryErrors["errors"] = $validator->errors();
                
                $aryResponse = $aryErrors;
                
            }else{
                
                $ownExpensesModel=new OwnExpenses;
            
                $aryResponse = $ownExpensesModel->submitForm($data["ownExpenses"]);
            }
            

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
