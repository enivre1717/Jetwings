<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Models\Common;

class CommonController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /* Retrieve Other Expenses Claim Options
     * 
     * @params GET data
     * @return json
     */
    public function getOtherExpensesClaimOptions(){
        
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $CommonModel=new Common;
            
            $aryResponse = $CommonModel->getOtherExpensesClaimOptions();

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
    
}
