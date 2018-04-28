<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Models\ArrivalForms;

class ArrivalFormController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /* Retrieve Arrival Form
     * 
     * @params GET data
     * @return json
     */
    public function index($fitbookingId){
        
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $arrivalFormsModel=new ArrivalForms;
            
            $aryResponse = $arrivalFormsModel->getArrivalFormDetails($fitbookingId, Auth::id());

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
    
    /* Submit Arrival Form
     * 
     * @params POST data
     * @return json
     */
    public function submitForm(Request $request){
        
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $arrivalFormsModel=new ArrivalForms;
            
            $data = json_decode($request->getContent(), true);
            
            $aryResponse = $arrivalFormsModel->insertArrivalFormDetails($data["arrivalForms"]);

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
