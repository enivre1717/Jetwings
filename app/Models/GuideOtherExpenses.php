<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideOtherExpenses extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guide_other_expenses';
    
    /**
     * One:One relationship between tourguide_claims & guide_income_products
     */
    public function claims()
    {
        return $this->belongsTo('App\Models\TourGuideClaims',"tour_guide_claim_id","id");
    }
    
    /* Insert/ Update/ Delete Other Expenses
     * 
     * @params object $claimModel, array $otherExpenses
     */
    public function updateOtherExpenses($claimModel, $otherExpenses){
        
        $aryOtherExpenses = array();
        
        foreach($otherExpenses as $key=>$value){
            if(!empty($value["id"])){
                
                $otherExpensesModel = GuideOtherExpenses::find($value["id"]);
                
                //if id is not empty, claim_option_id also not empty
                if(!empty($value["claim_option_id"])){
                    
                    //update
                    $otherExpensesModel->expenses = $value["expenses"];
                    $otherExpensesModel->other_expenses = $value["other_expenses"];
                    $otherExpensesModel->amount = $value["amount"];
                    $otherExpensesModel->claim_option_id=  $value["claim_option_id"];
                    $otherExpensesModel->timestamps = false;
                    $aryOtherExpenses[] = $otherExpensesModel;
                    
                }else{
                    //delete
                    
                    $otherExpensesModel->delete();
                }
                
            }else{
                
                //if id is empty and claim_option_id is not empty
                
                if(!empty($value["claim_option_id"])){
                    //insert
                    $otherExpensesModel = new GuideOtherExpenses;
                    $otherExpensesModel->expenses = $value["expenses"];
                    $otherExpensesModel->other_expenses = $value["other_expenses"];
                    $otherExpensesModel->amount = $value["amount"];
                    $otherExpensesModel->claim_option_id=  $value["claim_option_id"];
                    $otherExpensesModel->timestamps = false;
                    $aryOtherExpenses[] = $otherExpensesModel;
                }
            }//if id 
            
        }//foreach
        

        if(count($aryOtherExpenses)>0){
            $claimModel->otherExpenses()->saveMany($aryOtherExpenses);
        }
            
    }
}
