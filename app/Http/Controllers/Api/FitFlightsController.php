<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\FitBookings;

class FitFlightsController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /* Retrieve 2nd Arrival details
     * 
     * @params POST data
     * @return json
     */
    public function getArrivalDetails(Request $request){
        
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $fitbookingId = $request->input("fitbookingId");
            $callNum = $request->input("callNum");
            
            $fitbookingsModel=new FitBookings;
            
            $aryResponse = $fitbookingsModel->getArrivalDetails($fitbookingId, $callNum);

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
