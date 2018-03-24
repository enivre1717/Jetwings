<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\OwnExpenses;

class OwnExpensesController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /* Submit Own Expenses Form
     * 
     * @params POST data
     * @return json
     */
    public function submitForm(Request $request){
        
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $ownExpensesModel=new OwnExpenses;
            
            $aryResponse = $ownExpensesModel->submitForm($request->input("ownExpenses"));

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
