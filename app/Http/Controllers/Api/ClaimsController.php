<?php

namespace App\Http\Controllers\Api;

use Validator;
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
            
            $data = json_decode($request->getContent(), true);
            
            $validator = Validator::make($data["claim"], [
                'expenses_restaurants.*.other_restaurant' => 'required_if:expenses_restaurants.*.restaurant_id,0',
                'income_owns.*.other_attraction' => 'required_if:income_owns.*.attraction_id,0',
                'ticket_expenses.*.other_ticket' => 'required_if:ticket_expenses.*.ticket,0',
            ],[
                'expenses_restaurants.*.other_restaurant.required_if' => '其他餐厅不能为空!',
                'income_owns.*.other_attraction.required_if' => '其他自费项目不能为空!',
                'ticket_expenses.*.other_ticket.required_if' => '其他门票不能为空!',
            ]);
            
            if ($validator->fails()) {
                $aryErrors["errors"] = $validator->errors();
                
                $aryResponse = $aryErrors;
                
            }else{
                $claimsModel=new TourguideClaims;
            
                $aryResponse = $claimsModel->submitClaims($data["claim"]);
            }
            

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
