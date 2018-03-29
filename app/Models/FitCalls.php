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
}
