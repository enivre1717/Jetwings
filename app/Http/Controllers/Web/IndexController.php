<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class IndexController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /* Load index page*/
    public function index(){
        
        
        return view('index');
        
    }
    
    /* Load login page*/
    public function login(){
        
        
        return view('login');
        
    }
    
    
}
