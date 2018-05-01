<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideExpensesFees extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guide_expenses_fees';
    
    /**
     * One:One relationship between tourguide_claims & guide_income_products
     */
    public function claims()
    {
        return $this->belongsTo('App\Models\TourguideClaims',"tour_guide_claim_id","id");
    }
    
    /* Insert/ Update/ Delete Expenses Fee
     * 
     * @params object $claimModel, array $expensesFees
     */
    public function updateExpensesFees($claimModel, $expensesFees){
        
        $aryExpensesFees = array();
        
        foreach($expensesFees as $key=>$value){
            //if have id, update
            if(!empty($value["id"])){
                $expensesFeeModel = self::find($value["id"]);
                
            }else{
                $expensesFeeModel = new GuideExpensesFees;
             }
             
             $expensesFeeModel->amount = $value["amount"];
             $expensesFeeModel->claim_option_id=  $value["claim_option_id"];
             $expensesFeeModel->timestamps = false;
             $aryExpensesFees[] = $expensesFeeModel;
        }
        
        if(count($aryExpensesFees)>0){
            $claimModel->expensesFees()->saveMany($aryExpensesFees);
        }
    }
    
}
