<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArrivalForms extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'arrival_forms';
    
    /**
     * One:One relationship with fit_bookings
     */
    public function fitBookings()
    {
        return $this->belongsTo('App\Models\FitBookings', "fit_booking_id");
    }
    
    /* Retrieve TG submitted arrival form details
     * 
     */
    public function getArrivalFormDetails($fitBookingId, $tourGuideId){
        
        //$results = self::where($strFilter)->get();
        
        $results = self::where([
                        "fit_booking_id"=>$fitBookingId,
                        "created_by"=>$tourGuideId,
                   ])->get();
        
        return $results;
    }  
}
