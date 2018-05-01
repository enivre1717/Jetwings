<?php

namespace App\Http\Controllers\Api;

use Validator;
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
            
            $data = json_decode($request->getContent(), true);
            
            $validator = Validator::make($data["arrivalForms"], [
                'tour_code' => 'required',
                'two_nd_arrival' => 'required',
                'departure_date' => 'required',
                'arrival_time' => 'required',
                'departure_flight' => 'required',
                'departure_time' => 'required',
                'tourGuideSignature' => 'required',
                'tourLeaderSignature' => 'required',
            ],[
                'tour_code.required' => '团号不能为空!',
                'two_nd_arrival.required' => '二次交接时间不能为空!',
                'departure_date.required' => '二次入新日期不能为空!',
                'arrival_time.required' => '二次交接时间不能为空!',
                'departure_flight.required' => '二次离新航班不能为空!',
                'departure_time.required' => '二次离新航班时间不能为空!',
                'tourGuideSignature.required' => '导游确认不能为空!',
                'tourLeaderSignature.required' => '领队确认不能为空!',
            ]);
            
            if ($validator->fails()) {
                $aryErrors["errors"] = $validator->errors();
                
                $aryResponse = $aryErrors;
                
            }else{
                $arrivalFormsModel=new ArrivalForms;
            
                $aryResponse = $arrivalFormsModel->insertArrivalFormDetails($data["arrivalForms"]);
            }
            
        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
