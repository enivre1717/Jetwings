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
     * @params int $fitBookingId, $tourGuideId
     * @return obj $results
     */
    public function getArrivalFormDetails($fitBookingId, $tourGuideId){
        
        //$results = self::where($strFilter)->get();
        
        $results = self::where([
                        "fit_booking_id"=>$fitBookingId,
                        "created_by"=>$tourGuideId,
                   ])->get();
        
        return $results;
    }
    
    /* Insert arrival form details
     * 
     * @params array $arrivalForms
     * @return boolean
     */
    public function insertArrivalFormDetails($arrivalForms){
        
        $arrivalFormsModel = new ArrivalForms;
        
        $arrivalFormsModel->fit_booking_id = $arrivalForms["fit_booking_id"];
        $arrivalFormsModel->tour_code = $arrivalForms["tour_code"];
        $arrivalFormsModel->two_nd_arrival = $arrivalForms["two_nd_arrival"];
        $arrivalFormsModel->departure_date = $arrivalForms["departure_date"];
        $arrivalFormsModel->arrival_time = $arrivalForms["arrival_time"];
        $arrivalFormsModel->departure_flight = $arrivalForms["departure_flight"];
        $arrivalFormsModel->departure_time = $arrivalForms["departure_time"];
        $arrivalFormsModel->created_by = Auth::id();
        $arrivalFormsModel->updated_by = Auth::id();
        
        if($arrivalFormsModel->save()){
            return true;
        }else{
            return false;
        }
    }
}
