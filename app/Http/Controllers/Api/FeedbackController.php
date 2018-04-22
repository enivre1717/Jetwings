<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Feedback;

class FeedbackController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function submitForm(Request $request){
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $feedbackModel = new Feedback;
            // var_dump($request->input("feedback"));
            // exit;
            $aryResponse = $feedbackModel->submitForm($request->input("feedback"));

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}