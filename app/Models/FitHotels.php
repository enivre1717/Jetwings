<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FitHotels extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'fit_hotels';
    
    /**
     * One:One relationship between fit_calls & fit_hotels
     */
    public function calls()
    {
        return $this->belongsTo('App\Models\FitCalls');
    }
    
    /**
     * One:One relationship between fit_hotels & hotels
     */
    public function hotels()
    {
        return $this->belongsTo('App\Models\Hotels',"hotel_id");
    }
    
    /* Retrieve hotels by fitbooking Id
     * 
     * @params int $fitBookingId
     * @return array
     */
    public function getHotelDetailsByBookingID($fitBookingId){
        
        $result=self::leftJoin('fit_calls', 'fit_hotels.fit_call_id','=','fit_calls.id')
                ->join('hotels',"fit_hotels.hotel_id",'=',"hotels.id")
                ->where([
                    ["fit_calls.fit_booking_id","=",$fitBookingId]
                ])
                ->select(['fit_hotels.*', 'fit_calls.call_num','hotels.name', DB::raw('DATEDIFF(fit_hotels.check_out,fit_hotels.check_in) As duration')])
                ->get();
                //->toSql();
        
        
        return $result;
        
    }
    
}
