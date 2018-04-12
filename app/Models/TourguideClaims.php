<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TourguideClaims extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tourguide_claims';
    
    /**
     * One:One relationship between fit_bookings & tourguide_claims
     */
    public function fitBookings()
    {
        return $this->belongsTo('App\Models\FitBookings',"fit_booking_id","id");
    }
    
    /**
     * One:Many relationship between tourguide_claims & guide_driver_tips
     */
    public function driverTips()
    {
        return $this->hasMany('App\Models\GuideDriverTips',"tour_guide_claim_id");
    }
    
    /**
     * One:Many relationship between tourguide_claims & guide_expenses_fees
     */
    public function expensesFees()
    {
        return $this->hasMany('App\Models\GuideExpensesFees',"tour_guide_claim_id");
    }
    
    /**
     * One:Many relationship between tourguide_claims & guide_expenses_restaurants
     */
    public function expensesRestaurants()
    {
        return $this->hasMany('App\Models\GuideExpensesRestaurants',"tour_guide_claim_id");
    }
    
    /**
     * One:Many relationship between tourguide_claims & guide_expenses_taxis
     */
    public function expensesTaxis()
    {
        return $this->hasMany('App\Models\GuideExpensesTaxis',"tour_guide_claim_id");
    }
    
    /**
     * One:Many relationship between tourguide_claims & guide_expenses_tips
     */
    public function expensesTips()
    {
        return $this->hasMany('App\Models\GuideExpensesTips',"tour_guide_claim_id");
    }
    
    /**
     * One:Many relationship between tourguide_claims & guide_income_owns
     */
    public function incomeOwns()
    {
        return $this->hasMany('App\Models\GuideIncomeOwns',"tour_guide_claim_id");
    }
    
    /**
     * One:Many relationship between tourguide_claims & guide_income_products
     */
    public function incomeProducts()
    {
        return $this->hasMany('App\Models\GuideIncomeProducts',"tour_guide_claim_id");
    }
    
    /**
     * One:Many relationship between tourguide_claims & guide_other_expenses
     */
    public function otherExpenses()
    {
        return $this->hasMany('App\Models\GuideOtherExpenses',"tour_guide_claim_id");
    }
    
    /**
     * One:Many relationship between tourguide_claims & guide_other_incomes
     */
    public function otherIncomes()
    {
        return $this->hasMany('App\Models\GuideOtherIncomes',"tour_guide_claim_id");
    }
    
    /**
     * One:Many relationship between tourguide_claims & guide_ticket_expenses
     */
    public function ticketExpenses()
    {
        return $this->hasMany('App\Models\GuideTicketExpenses',"tour_guide_claim_id");
    }
    
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
    
    public function getAClaim($fitBookingId, $tourGuideId){
        
        $result=self::with(["fitBookings" => function($query){
                    return $query->select(["id","pax_update","driver_tips"]);
                },"driverTips","expensesFees","expensesRestaurants","expensesTaxis","expensesTips",
                "incomeOwns","incomeProducts","otherExpenses","otherIncomes","TicketExpenses"])
                ->where([
                    ["fit_booking_id","=",$fitBookingId],
                    ["status","<>", "Deleted"],
                    ["tour_guide_id","=", $tourGuideId]
                ])
                ->get();
                //->toSql();
        
        return $result;
    }
    
}
