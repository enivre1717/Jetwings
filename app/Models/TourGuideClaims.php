<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TourGuideClaims extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tourguide_claims';
    
    /* Returns if the tour guide have done the claims
     * 
     * @params int $fitBookingId, int $tourGuideId
     * @return array
     */
    public function hasClaim($fitBookingId, $tourGuideId){
        
        $result=self::where([
                    ["fit_booking_id","=",$fitBookingId],
                    ["status","<>", "Deleted"],
                    ["tour_guide_id","=", $tourGuideId]
                ])
                ->count();
                //->toSql();
        
        if(count($result)<=0){
            return false;
        }else{
            return true;
        }
        
    }
    
}
