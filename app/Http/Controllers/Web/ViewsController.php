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
    
    /* Load safety contract form */
    public function safetyContract(){
        
        return view("safetycontract.index");
    }
    
    /* Load safety contract form */
    public function ownExpenses(){
        
        return view("ownexpenses.index");
    }
    
}
