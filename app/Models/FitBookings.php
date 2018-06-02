<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FitBookings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'fit_bookings';
    
    /**
     * One:Many relationship between fit_bookings & fit_transports
     */
    public function transports()
    {
        return $this->hasMany('App\Models\FitTransports', "fit_booking_id");
    }
    
    /**
     * One:Many relationship between fit_bookings & fit_calls
     */
    public function calls()
    {
        return $this->hasMany('App\Models\FitCalls',"fit_booking_id");
    }
    
    /**
     * One:One relationship between fit_bookings & arrival_forms
     */
    public function arrivalForms()
    {
        return $this->hasOne('App\Models\ArrivalForms',"id");
    }
    
    /**
     * One:Many relationship with tourguide_commissions
     */
    public function commissions()
    {
        return $this->hasMany('App\Models\TourguideCommissions',"fit_booking_id");
    }
    
    /**
     * One:Many relationship between fit_bookings & tourguide_claims
     */
    public function claims()
    {
        return $this->hasMany('App\Models\TourguideClaims',"fit_booking_id");
    }
    
    /* Retrieve all the bookings
     * 
     * @params POST input $data
     * @return array
     */
    public function getFitBookings($data){
        
        $data = json_decode($data->getContent(), true);
        
        $dateFrom = $data['dateFrom'];
        $dateTo = $data['dateTo'];
        $page = isset($data['page']) ? $data['page'] : 1;
        
        //$friendlyDateFrom=date("d-m-Y",strtotime(Common::unfriendly_short_date($dateFrom)));
        //$friendlyDateTo=date("d-m-Y",strtotime(Common::unfriendly_short_date($dateTo)));
        
        //form filter
        $strArrivalFilter="";
        $strDeptFilter="";
        $strArrivalSep="";
        $strDeptSep="";
        $strFilter="";
        $strSep="";
        
        $strFilter.=$strSep."fit_bookings.status='Active'";
        $strSep=" AND ";
        
        //$strFilter.=$strSep."fit_bookings.tour_guide_ids LIKE '%\'".Auth::id()."\'%'";
        $strFilter.=$strSep."fit_bookings.tour_guide_ids LIKE '%\'".Auth::guard("api")->id()."\'%'";
        $strSep=" AND ";
        
        if($dateFrom!=""){
            $strArrivalFilter.=$strArrivalSep."DATE(fit_flights.arrival_at)>='".$dateFrom."'";
            $strArrivalSep=" AND ";

            $strDeptFilter.=$strDeptSep."DATE(fit_flights.departure_at)>='".$dateFrom."'";
            $strDeptSep=" AND ";
        }

        if($dateTo!=""){

            $strArrivalFilter.=$strArrivalSep."DATE(fit_flights.arrival_at)<='".$dateTo."'";
            $strArrivalSep=" AND ";

            $strDeptFilter.=$strDeptSep."DATE(fit_flights.departure_at)<='".$dateTo."'";
            $strDeptSep=" AND ";

       }
       
       $strFilter2="";
       $strSep2="";
       
       if($strArrivalFilter!=""){
            $strFilter2.=$strSep2."($strArrivalFilter)";
            $strSep2=" OR ";
       }

       if($strDeptFilter!=""){
            $strFilter2.=$strSep2."($strDeptFilter)";
            $strSep2=" OR ";
       }
       
       if($strFilter2!=""){
           $strFilter.=$strSep."($strFilter2)";
           $strSep=" AND ";
       }
        
        $result=self::leftJoin('fit_calls', 'fit_bookings.id','=','fit_calls.fit_booking_id')
                ->leftJoin('fit_flights','fit_calls.id','=','fit_flights.fit_call_id')
                ->leftJoin('tours', 'fit_bookings.tour_id','=','tours.id')
                ->leftJoin('sale_agencies',"fit_bookings.sale_agency_id",'=',"sale_agencies.id")
                ->whereRaw($strFilter)
                ->select(['fit_bookings.*','sale_agencies.name AS company_name','fit_flights.fit_call_id',
                    'fit_flights.arrival_at','fit_flights.departure_at','tours.type'])
                ->groupBy("fit_bookings.id")
                ->orderBy("fit_bookings.tour_date")
                //->offset($page)
                //->limit(5)
                ->get();
                //->toSql();
        
        return $result;
    }
    
    /* Retrieve one booking
     * 
     * @params POST int $id
     * @return array
     */
    public function getFitBookingsById($id){
        
        $result = self::with(["transports", "calls","calls.hotels", "calls.flights","calls.hotels.hotels",
                              "transports.transportAgencies","transports.transports"])
                ->leftJoin('tours', 'fit_bookings.tour_id','=','tours.id')
                ->leftJoin('sale_agencies',"fit_bookings.sale_agency_id",'=',"sale_agencies.id")
                ->leftJoin('tour_guides',"fit_bookings.main_tour_guide_id",'=',"tour_guides.id")
                ->select(['fit_bookings.*','sale_agencies.name AS company_name','tours.type','tour_guides.name as tour_guide_name'])
                ->where([
                    ["fit_bookings.id","=",$id]
                ])->get();
                
        
        /*$result=self::leftJoin('tours', 'fit_bookings.tour_id','=','tours.id')
                ->leftJoin('sale_agencies',"fit_bookings.sale_agency_id",'=',"sale_agencies.id")
                ->where([
                    ["fit_bookings.id","=",$id]
                ])
                ->select(['fit_bookings.*','sale_agencies.name AS company_name','tours.type'])
                ->get();
                //->toSql();*/
        
        
        return $result;
        
    }
    
    /* Get Welcome Sign
     * 
     * @params POST int $id
     * @return array
     */
    public function getWelcomeSign($id){
        
        $result=self::leftJoin('sale_agencies', 'fit_bookings.sale_agency_id','=','sale_agencies.id')
                ->where([
                    ["fit_bookings.id","=",$id]
                ])
                ->select(['welcome_sign_type','welcome_sign_text','sale_agencies.name'])
                ->first();
        
        
        //$result->welcome_sign_text = $result->welcome_sign_text!="" ? $result->welcome_sign_text : $result->name;
        
        return $result;
    }
    
    /* Get Arrival Details
     * 
     * @params POST int $id
     * @return array
     */
    
    public function getArrivalDetails($id, $callNum){
        
        $result=self::with(["calls" =>function($query) use($callNum){
                    $query->where([
                            "fit_calls.call_num"=>$callNum
                        ]);
                }, "calls.flights"])
                ->where(["id"=>$id])->get();
        
        //die(print_r($result));
        
        return $result;
    }
    
}
