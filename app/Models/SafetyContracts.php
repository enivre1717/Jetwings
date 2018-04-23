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
        
        $contractModel = new SafetyContracts;
        
        $contractModel->name = $data['name'];
        $contractModel->nric = $data['nric'];
        $contractModel->fit_booking_id = $data['fitBookingId'];
        $contractModel->from_date = $data['fromDateYr']."-".$data['fromDateMonth']."-".$data['fromDateDay'];
        $contractModel->to_date = $data['toDateYr']."-".$data['toDateMonth']."-".$data['toDateDay'];
        $contractModel->join_date = $data['joinDateYr']."-".$data['joinDateMonth']."-".$data['joinDateDay'];
        $contractModel->created_by = Auth::id();
        $contractModel->updated_by = Auth::id();
        $contractModel->signature = $data['signature'];
        
        if($contractModel->save()){
            return true;
        }else{
            return false;
        }
    }
    
}
