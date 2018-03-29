<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FitFlights extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'fit_flights';
    
    /**
     * One:One relationship between fit_calls & fit_flights
     */
    public function flights()
    {
        return $this->belongsTo('App\Models\FitCalls');
    }
    
    /* Retrieve flights by fitbooking Id
     * 
     * @params int $fitBookingId, callNum, type (arrival/departure)
     * @return array
     */
    public function getFlightsByBookingID($fitBookingId,$callNum="",$type=""){
        
        $strFilter="";
        $strSep="";
        
        if($fitBookingId!=""){
            $strFilter.=$strSep."fit_calls.fit_booking_id=".$fitBookingId;
            $strSep=" AND ";
        }

        if($callNum!=""){
            $strFilter.=$strSep."fit_calls.call_num=".$callNum;
            $strSep=" AND ";
        }

        if($type!=""){
            $strFilter.=$strSep."fit_flights.type=".$type;
            $strSep=" AND ";
        }
            
        $result=self::leftJoin('fit_calls', 'fit_flights.fit_call_id','=','fit_calls.id')
                ->whereRaw($strFilter)
                ->select(['fit_flights.*', 'fit_calls.call_num'])
                ->get();
                //->toSql();
        
        
        return $result;
        
    }
    
}
