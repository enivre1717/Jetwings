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
        
        if($result<=0){
            return false;
        }else{
            return true;
        }
        
    }
    
    public function getAClaim($fitBookingId, $tourGuideId){
        
        $result=self::with(["fitBookings" => function($query){
                    return $query->select(["id","pax_update","driver_tips"]);
                },"driverTips","expensesFees","expensesRestaurants","expensesTaxis","expensesTips",
                "incomeOwns","incomeProducts","otherExpenses","otherIncomes","TicketExpenses", "expensesRestaurants.restaurants",
                "TicketExpenses.tickets", "incomeOwns.attractions"
                ])
                ->where([
                    ["fit_booking_id","=",$fitBookingId],
                    ["status","<>", "Deleted"],
                    ["tour_guide_id","=", $tourGuideId]
                ])
                ->get();
                //->toSql();
        
        return $result;
    }
    
    public function submitClaims($claim){
        
        return self::updateClaims($claim);
    }
    
    /* Insert/ Update Claim into DB
     * 
     * @params array $claim
     * @return boolean
     */
    public function updateClaims($claim){
        
        $hasSaved = false;
        
        if(empty($claim["id"])){
            
            //insert into DB
            $claimModel = new TourguideClaims;

            $claimModel->fit_booking_id = $claim['fit_booking_id'];
            $claimModel->tour_guide_id = Auth::guard("api")->id();
            $claimModel->advance_cash = !empty($claim['advance_cash']) ? $claim['advance_cash'] : 0;
            $claimModel->status = "Pending";
            $claimModel->added_by_id = Auth::guard("api")->id();
            $claimModel->updated_by_id = Auth::guard("api")->id();
        
        }else{
            
            //update into DB
            $claimModel = TourguideClaims::find($claim["id"]);

            $claimModel->advance_cash = !empty($claim['advance_cash']) ? $claim['advance_cash'] : 0;
        }
        
        if($claimModel->save()){
            
            $hasSaved = true;
            
            if(isset($claim["expenses_fees"])){
                $expensesFeeModel = new GuideExpensesFees;
                $expensesFeeModel->updateExpensesFees($claimModel,$claim["expenses_fees"]);
            }
            
            if(isset($claim["expenses_restaurants"])){
                $expensesRestaurantsModel = new GuideExpensesRestaurants;
                $expensesRestaurantsModel->updateExpensesRestaurant($claimModel,$claim["expenses_restaurants"]);
            }
            
            if(isset($claim["expenses_taxis"])){
                $expensesTaxisModel = new GuideExpensesTaxis;
                $expensesTaxisModel->updateExpensesTaxis($claimModel,$claim["expenses_taxis"]);
            }
            
            if(isset($claim["expenses_tips"])){
                $expensesTipsModel = new GuideExpensesTips;
                $expensesTipsModel->updateExpensesTips($claimModel,$claim["expenses_tips"]);
            }
            
            if(isset($claim["ticket_expenses"])){
                
                $ticketExpensesModel = new GuideTicketExpenses;
                $ticketExpensesModel->updateTicketExpenses($claimModel,$claim["ticket_expenses"]);
                
            }
            
            if(isset($claim["other_expenses"])){
                
                $otherExpensesModel = new GuideOtherExpenses;
                $otherExpensesModel->updateOtherExpenses($claimModel,$claim["other_expenses"]);
                
            }
            
            if(isset($claim["income_owns"])){
                
                $incomeOwnsModel = new GuideIncomeOwns;
                $incomeOwnsModel->updateIncomeOwns($claimModel,$claim["income_owns"]);
                
            }
            
            if(isset($claim["income_products"])){
                
                $incomeProductsModel = new GuideIncomeProducts;
                $incomeProductsModel->updateIncomeProducts($claimModel,$claim["income_products"]);
                
            }
            
            if(isset($claim["other_incomes"])){
                
                $otherIncomesModel = new GuideOtherIncomes;
                $otherIncomesModel->updateOtherIncomes($claimModel,$claim["other_incomes"]);
                
            }
            
        }//if saved
        
        return $hasSaved;
    }
    
}
