<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\SaleAgencies;

class SaleAgenciesController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /* Get Company Name by Id
     * 
     * @params GET $id
     * @return json
     */
    public function getSaleAgenciesById(Request $request, $id){
        
        try{
            
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $saleAgenciesModel=new SaleAgencies;

            $aryResponse = $saleAgenciesModel->getCompanyNameById($id);

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}
