<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TourguideCommissions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tourguide_commissions';
    
    /**
     * One:One relationship with fit_bookings
     */
    public function fitBookings()
    {
        return $this->belongsTo('App\Models\FitBookings',"fit_booking_id","id");
    }
    
    /**
     * One:Many relationship with tourguide_commission_items
     */
    public function commissionItems()
    {
        return $this->hasMany('App\Models\TourguideCommissionItems', "tourguide_commission_id");
    }
    
    /**
     * One:One relationship with tour_guides
     */
    public function tourguides()
    {
        return $this->belongsTo('App\Models\TourGuides',"added_by_id");
    }
    
    /* Retrieve TG submitted commission claim
     * 
     * @params int $fitBookingId, $tourGuideId
     * @return obj $results
     */
    public function getCommissionClaimsDetails($fitBookingId, $tourGuideId){
        
        //$results = self::where($strFilter)->get();
        
        $results = self::with([
                        "commissionItems",
                        "tourguides" => function($query){
                            $query->select(["id","name"]);
                        },
                        "fitBookings" => function($query){
                            $query->select(["id","tour_code","tour_leader"]);
                        }])->where([
                            "fit_booking_id"=>$fitBookingId,
                            "added_by_id"=>$tourGuideId,
                            ["status","<>","Deleted"]
                       ])->get();
        
        return $results;
    }
    
    /* Insert commission claims
     * 
     * @params array $commissions
     * @return boolean
     */
    public function insertCommissionClaims($commissions){
        
        $hasSaved = false;
        $aryItems = array();
        
        $commissionClaimsModel = new TourguideCommissions;
        
        
        $commissionClaimsModel->fit_booking_id = $commissions['fit_booking_id'];
        $commissionClaimsModel->tour_guide_id = Auth::id();
        $commissionClaimsModel->jewellery_sgd = $commissions['jewellery_sgd'];
        $commissionClaimsModel->jewellery_rmb = $commissions['jewellery_rmb'];
        $commissionClaimsModel->yong_ann_sgd = $commissions['yong_ann_sgd'];
        $commissionClaimsModel->yong_ann_rmb = $commissions['yong_ann_rmb'];
        $commissionClaimsModel->date = date("Y-m-d",strtotime($commissions['date']));
        $commissionClaimsModel->sgd_to_company = $commissions['sgd_to_company'];
        $commissionClaimsModel->rmb_to_company = $commissions['rmb_to_company'];
        $commissionClaimsModel->status = "Active";
        
        $commissionClaimsModel->added_by_id = Auth::id();
        $commissionClaimsModel->updated_by_id = Auth::id();
        
        if($commissionClaimsModel->save()){
            
            $hasSaved = true;
            
            foreach($commissions["commission_items"] as $key=>$value){
                $itemsModel = new TourguideCommissionItems;
                //$itemsModel->item = $value["item"];
                $itemsModel->rmb = $value["rmb"];
                $itemsModel->sgd = $value["sgd"];
                $itemsModel->remarks = $value["remarks"];
                $itemsModel->qty = $value["qty"];
                $aryItems[] = $itemsModel;
                $itemsModel->timestamps = false;
            }
            
            $commissionClaimsModel->commissionItems()->saveMany($aryItems);
            
        }
        
        return $hasSaved;
    }
}
