<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FitCalls extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'fit_calls';
    
    /**
     * One:One relationship between fit_bookings & fit_calls
     */
    public function fitBookings()
    {
        return $this->belongsTo('App\Models\FitBookings');
    }
    
    /**
     * One:Many relationship between fit_calls & fit_hotels
     */
    public function hotels()
    {
        return $this->hasMany('App\Models\FitHotels',"fit_call_id");
    }
    
    /**
     * One:Many relationship between fit_calls & fit_flights
     */
    public function flights()
    {
        return $this->hasMany('App\Models\FitFlights',"fit_call_id");
    }
    
    /* Check has 2nd Call
     * 
     * @params POST int $id
     * @return array
     */
    public function has2ndCall ($id){
        
        $resultNum = self::where(["fit_booking_id"=>$id, "call_num" => 2])->count();
            
        if($resultNum<=0){
            return false;
        }else{
            return true;
        }
    }
}
