<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\TourGuides;

class TourGuidesController extends \App\Http\Controllers\Controller
{
    
    public function login(Request $request){
        
        try{
            
            $apiToken="";
            $aryErrors = array();
            $statusCode=config("app.status_code.OK");
            
            $username = $request->input("username");
            $password = $request->input("password");
            
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ],[
                "required" => ":attribute cannot be empty."
            ]);
            
            if ($validator->fails()) {
                $aryErrors["errors"] = $validator->errors();
                
                return response()->json($aryErrors, $statusCode);
            }else{
                $tourguideModel = new TourGuides();

                $apiToken=$tourguideModel->authenicateTourGuide($username,$password);

                if(!empty($apiToken)){
                    return response()->json($apiToken, $statusCode);
                }else{
                    
                    $aryErrors["errors"] = array("password"=>array("Incorrect username or password."));
                    
                    return response()->json($aryErrors, $statusCode);
                }
            }
            
        }catch(Exception $ex){
            
            $statusCode = config("app.status_code.Exception");
            
            return response()->json($ex->getMessage(), $statusCode);
        }
    }
    
    public function logout(Request $request){
        
        try{
            
            $tourguideModel = new TourGuides();
            
            $isLogout=$tourguideModel->logout();

            if($isLogout){
                return response()->json(true, 200);
            }else{
                return response()->json("Error logging user out.", 400);
            }
            
        }catch(Exception $ex){
            return response()->json($ex->getMessage(), 400);
        }
    }
    
    public function getTourGuideDetails(){
        
        try{
            $statusCode = config("app.status_code.OK");
            
            $tourguideModel = new TourGuides;
            
            $aryResponse = $tourguideModel->getTourGuideDetails();
            
            return response()->json($aryResponse, $statusCode);
            
        }catch(Exception $ex){
            $statusCode = config("app.status_code.Exception");
            
            return response()->json($ex->getMessage(), $statusCode);
        }
        
    }
}
