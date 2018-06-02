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
        
        if(isset($results[0])){
            $results[0]->tour_leader_signature = json_encode($results[0]->tour_leader_signature);
            $results[0]->tour_guide_signature = json_encode($results[0]->tour_guide_signature);
        }
        
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
        $commissionClaimsModel->tour_guide_id = Auth::guard("api")->id();
        $commissionClaimsModel->jewellery_sgd = isset($commissions['jewellery_sgd']) ? $commissions['jewellery_sgd'] : 0;
        $commissionClaimsModel->jewellery_rmb = isset($commissions['jewellery_rmb']) ? $commissions['jewellery_rmb'] : 0;
        $commissionClaimsModel->yong_ann_sgd = isset($commissions['yong_ann_sgd']) ? $commissions['yong_ann_sgd'] : 0;
        $commissionClaimsModel->yong_ann_rmb = isset($commissions['yong_ann_rmb']) ? $commissions['yong_ann_rmb'] : 0;
        $commissionClaimsModel->date = date("Y-m-d");
        $commissionClaimsModel->sgd_to_company = isset($commissions['sgd_to_company']) ? $commissions['sgd_to_company'] : 0;
        $commissionClaimsModel->rmb_to_company = isset($commissions['rmb_to_company']) ? $commissions['rmb_to_company'] : 0;
        $commissionClaimsModel->tour_guide_signature = isset($commissions['tour_guide_signature']) ? $commissions['tour_guide_signature'] : "";
        $commissionClaimsModel->tour_leader_signature = isset($commissions['tour_leader_signature']) ? $commissions['tour_leader_signature'] : "";
        $commissionClaimsModel->status = "Active";
        
        $commissionClaimsModel->added_by_id = Auth::guard("api")->id();
        $commissionClaimsModel->updated_by_id = Auth::guard("api")->id();
        
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
