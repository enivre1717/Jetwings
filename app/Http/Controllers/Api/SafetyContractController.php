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
            
            $validator = Validator::make($request->input("contract"), [
                'name' => 'required',
                'nric' => 'required|checkNric:'.$request->input("contract")["fitBookingId"],
                'signature' => 'required',
                'fromDateYr' => 'digits:4',
                'fromDateDay' => 'required|integer|between:1,31',
                'toDateYr' => 'digits:4',
                'toDateDay' => 'required|integer|between:1,31',
                'joinDateYr' => 'digits:4',
                'joinDateDay' => 'required|integer|between:1,31',
            ],[
                "name.required" => "名字不能为空!",
                "nric.required" => "护照号码不能为空!",
                "nric.checkNric" => "护照号码已提交表单!",
                "signature.required" => "签名不能为空!",
                "fromDateDay.required" => "从日期不能为空!",
                "fromDateYr.digits" => "从日期不是有效日期!",
                "fromDateDay.between" => "从日期不是有效日期!",
                "toDateDay.required" => "离团日期不能为空!",
                "toDateYr.digits" => "离团日期不是有效日期!",
                "toDateDay.between" => "离团日期不是有效日期!",
                "joinDateDay.required" => "归团日期不能为空!",
                "joinDateYr.digits" => "归团日期不是有效日期!",
                "joinDateDay.between" => "归团日期不是有效日期!",
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
