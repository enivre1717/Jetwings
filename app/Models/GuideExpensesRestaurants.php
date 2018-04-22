<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideExpensesRestaurants extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guide_expenses_restaurants';
    
    /**
     * One:One relationship between tourguide_claims & guide_expenses_restaurants
     */
    public function claims()
    {
        return $this->belongsTo('App\Models\TourGuideClaims',"tour_guide_claim_id","id");
    }
    
    /**
     * One:One relationship between restaurants & guide_expenses_restaurants
     */
    public function restaurants()
    {
        return $this->belongsTo('App\Models\Restaurants',"restaurant_id","id");
    }
    
    /* Insert/ Update/ Delete Expenses Fee
     * 
     * @params object $claimModel, array $expensesRestaurants
     */
    public function updateExpensesRestaurant($claimModel, $expensesRestaurants){
        
        $aryExpensesRestaurants = array();
        
        foreach($expensesRestaurants as $key=>$value){
            
            if(!empty($value["id"])){
                
                $expensesRestaurantsModel = GuideExpensesRestaurants::find($value["id"]);
                
                //if id is not empty, restaurant_id also not empty
                if(is_numeric($value["restaurant_id"])){
                    
                    //update
                    $expensesRestaurantsModel->restaurant_id = $value["restaurant_id"];
                    $expensesRestaurantsModel->other_restaurant = $value["other_restaurant"];
                    $expensesRestaurantsModel->amount = $value["amount"];
                    $expensesRestaurantsModel->claim_option_id=  $value["claim_option_id"];
                    $expensesRestaurantsModel->timestamps = false;
                    $aryExpensesRestaurants[] = $expensesRestaurantsModel;
                    
                    
                }else{
                    //delete
                    
                    $expensesRestaurantsModel->delete();
                }
                
            }else{
                
                //if id is empty and restaurant_id is not empty
                if(is_numeric($value["restaurant_id"])){
                    //insert
                    $expensesRestaurantsModel = new GuideExpensesRestaurants;
                    $expensesRestaurantsModel->restaurant_id = $value["restaurant_id"];
                    $expensesRestaurantsModel->other_restaurant = $value["other_restaurant"];
                    $expensesRestaurantsModel->amount = $value["amount"];
                    $expensesRestaurantsModel->claim_option_id=  $value["claim_option_id"];
                    $expensesRestaurantsModel->timestamps = false;
                    $aryExpensesRestaurants[] = $expensesRestaurantsModel;
                }
            }//if id 
            
        }//foreach
        
        if(count($aryExpensesRestaurants)>0){
            $claimModel->expensesRestaurants()->saveMany($aryExpensesRestaurants);
        }
            
    }
    
}
