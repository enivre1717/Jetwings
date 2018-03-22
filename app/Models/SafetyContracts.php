<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SafetyContracts extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'safety_contracts';
    
    /* Submit form
     * 
     * @params array from data
     * @return boolean
     */
    public function submitForm($data){
        
        $name = $data->input('dateFrom');
        $FromDateYr = $data->input('dateTo');
        $FromDateMth = $data->input('dateTo');
        $FromDateDay = $data->input('dateTo');
        
        
        
    }
    
}
