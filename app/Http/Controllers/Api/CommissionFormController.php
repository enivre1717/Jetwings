<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Models\TourguideCommissions;

class CommissionFormController extends \App\Http\Controllers\Controller
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
            
            $CommissionFormModel=new TourguideCommissions;
            
            $aryResponse = $CommissionFormModel->getCommissionClaimsDetails($fitbookingId, Auth::id());

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
            
            $data = json_decode($request->getContent(), true);
            
            $validator = Validator::make($data["commissions"], [
                'tour_guide_signature' => 'required',
                'tour_leader_signature' => 'required',
            ],[
                'tour_guide_signature.required' => '导游确认不能为空!',
                'tour_leader_signature.required' => '领队确认不能为空!',
            ]);
            
            if ($validator->fails()) {
                $aryErrors["errors"] = $validator->errors();
                
                $aryResponse = $aryErrors;
                
            }else{
                $commissionFormModel=new TourguideCommissions;

                $aryResponse = $commissionFormModel->insertCommissionClaims($data["commissions"]);
            }
            
        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
