<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\FitTransports;
use App\Models\TourGuides;

class FitTransportsController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /* Retrieve transports by FITBookingID
     * 
     * @params int FITBookingID
     * @return json
     */
    public function getFitTransportsById($id){
        
        try{
            
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $fitTransportsModel=new FitTransports;

            $aryResponse = $fitTransportsModel->getTransportsByBookingID($id);

            
        }catch(\Exception $e){
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
            $statusCode=config("app.status_code.Exception");
        }
        
        return response()->json($aryResponse, $statusCode);
        
    }//getFitBookingById
   
}
