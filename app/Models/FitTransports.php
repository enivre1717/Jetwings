<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FitTransports extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'fit_transports';
    
    /**
     * One:One relationship between fit_bookings & fit_transports
     */
    public function fitBookings()
    {
        return $this->belongsTo('App\Models\FitBookings');
    }
    
    /**
     * One:One relationship between fit_transports & transports
     */
    public function transports()
    {
        return $this->belongsTo('App\Models\Transports',"transport_id");
    }
    
    /**
     * One:One relationship between fit_transports & transport_agencies
     */
    public function transportAgencies()
    {
        return $this->belongsTo('App\Models\TransportAgencies',"transport_agency_id");
    }
    
    /* Retrieve transports by fitbooking Id
     * 
     * @params int $fitBookingId
     * @return array
     */
    public function getTransportsByBookingID($fitBookingId){
        
        $result=self::join('transports', 'fit_transports.transport_id','=','transports.id')
                ->join('transport_agencies',"fit_transports.transport_agency_id",'=',"transport_agencies.id")
                ->where([
                    ["fit_transports.fit_booking_id","=",$fitBookingId]
                ])
                ->select(['fit_transports.*', 'transports.name AS transport_name','transport_agencies.name AS agency'])
                ->get();
                //->toSql();
        
        
        return $result;
        
    }
    
}
