<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;


class ViewsController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /* Load booking listings */
    public function listBookings(){
        
        return view("fitbookings.list");
    }
    
    /* Load forms */
    public function forms(){
        
        return view("fitbookings.forms");
    }
    
    /* Load booking details*/
    public function bookingDetails(){
        return view("fitbookings.details");
    }
    
    /* Load safety contract form */
    public function safetyContract(){
        
        return view("safetycontract.index");
    }
    
    /* Load safety contract form */
    public function ownExpenses(){
        
        return view("ownexpenses.index");
    }
    
    /* Load Welcome page */
    public function welcome(){
        return view("fitbookings.welcome");
    }
    
    /* Load Arrival page */
    public function arrival(){
        return view("arrival.index");
    }
    
    /* Load error page */
    public function error($errorCode){
        if($errorCode == 404){
            return view("errors.404");
        }
    }
    
}
