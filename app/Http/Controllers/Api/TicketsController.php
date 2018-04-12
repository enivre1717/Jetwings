<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Tickets;

class TicketsController extends \App\Http\Controllers\Controller
{
    
    public function getTickets(){
        
        try{
            $statusCode = config("app.status_code.OK");
            
            $ticketsModel = new Tickets;
            
            $aryResponse = $ticketsModel->getTickets();
            
            return response()->json($aryResponse, $statusCode);
            
        }catch(Exception $ex){
            $statusCode = config("app.status_code.Exception");
            
            return response()->json($ex->getMessage(), $statusCode);
        }
        
    }
}
