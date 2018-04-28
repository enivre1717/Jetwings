<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Models\TourguideClaims;

class ClaimsController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /* Retrieve Commission Form
     * 
     * @params GET data
     * @return json
     */
    public function index($fitbookingId){
        
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $ClaimsModel=new TourguideClaims;
            
            $aryResponse = $ClaimsModel->getAClaim($fitbookingId, Auth::guard("api")->id());
            
        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
    
    /* Submit Commission Claims Form
     * 
     * @params POST data
     * @return json
     */
    public function submitForm(Request $request){
        
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $claimsModel=new TourguideClaims;
            
            $data = json_decode($request->getContent(), true);
            
            $aryResponse = $claimsModel->submitClaims($data["claim"]);

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
