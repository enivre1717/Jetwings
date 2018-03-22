<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\SafetyContracts;

class SafetyContractController extends Controller
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
            
            $safetyContractModel=new SafetyContracts;

            $aryResponse = $safetyContractModel->submitForm($request);

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
