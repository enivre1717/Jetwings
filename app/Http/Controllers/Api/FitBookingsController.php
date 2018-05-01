<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Models\FitBookings;
use App\Models\FitTransports;
use App\Models\FitFlights;
use App\Models\FitHotels;
use App\Models\FitCalls;
use App\Models\TourGuides;
use App\Models\TourguideClaims;

class FitBookingsController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /* Retrieve all the bookings
     * 
     * @params POST input $request
     * @return json
     */
    public function getFitBookings(Request $request){
        
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            $fitBookingModel=new FitBookings();
            
            //$aryResponse=$fitBookingModel->getFitBookings($request);
            
            $fitbookingResults=$fitBookingModel->getFitBookings($request);
            
            $aryResponse = array();
            
            $i=0;
            foreach($fitbookingResults as $value){
                
                $aryResponse[$i]["fitbookings"]= $value;
                
                $fitTransportsModel=new FitTransports();
                
                //retrieve transport details
                $fitTransportsResults = $fitTransportsModel->getTransportsByBookingID($value->id);
                
                $aryResponse[$i]["fitTransports"]= $fitTransportsResults;
                
                //retrieve first call flight details
                $fitFlightsModel=new FitFlights();
                
                $fitFlightsResults = $fitFlightsModel->getFlightsByBookingID($value->id, 1);
                
                $aryResponse[$i]["fitFlights"]= $fitFlightsResults;
                
                //retrieve first call hotel details
                $fitHotelsModel=new FitHotels();
                
                $fitHotelsResults = $fitHotelsModel->getHotelDetailsByBookingID($value->id);
                
                $aryResponse[$i]["fitHotels"]= $fitHotelsResults;
                
                //retrieve if tour guide has submitted the claim
                $tourguideClaimsModel=new TourguideClaims();
                
                $tourGuideClaimResults = $tourguideClaimsModel->hasClaim($value->id, Auth::id());
                
                $aryResponse[$i]["hasClaim"]= $tourGuideClaimResults;
                
                $i++;
            }//foreach

            
        }catch(\Exception $e){
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
            $statusCode=config("app.status_code.Exception");
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
    
    /* Retrieve one booking
     * 
     * @params GET input $request, int FITBookingID
     * @return json
     */
    public function getFitBookingsById(Request $request, $id){
        
        try{
            
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $fitBookingModel=new FitBookings;

            $aryResponse= $fitBookingModel->getFitBookingsById($id);

        }catch(\Exception $e){
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
            $statusCode=config("app.status_code.Exception");
        }
        
        return response()->json($aryResponse, $statusCode);
        
    }//getFitBookingById
    
    /* Retrieve welcome sign
     * 
     * @params POST input $request, int FITBookingID
     * @return json
     */
    public function getWelcomeSign(Request $request, $id){
        
        try{
            
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $fitBookingModel=new FitBookings;

            $aryResponse = $fitBookingModel->getWelcomeSign($id);

            
        }catch(\Exception $e){
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
            $statusCode=config("app.status_code.Exception");
        }
        
        return response()->json($aryResponse, $statusCode);
        
    }//getWelcome
    
    /* Check Booking has 2nd Call
     * 
     * @params POST input $request
     * @return json
     */
    public function has2ndCall(Request $request){
        
        try{
            
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $fitCallsModel=new FitCalls;

            $data = json_decode($request->getContent(), true);
            
            $aryResponse = $fitCallsModel->has2ndCall($data["fitBookingId"]);

            
        }catch(\Exception $e){
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
            $statusCode=config("app.status_code.Exception");
        }
        
        return response()->json($aryResponse, $statusCode);
        
    }//has2ndCall
}
