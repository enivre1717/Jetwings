<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideExpensesTaxis extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guide_expenses_taxis';
    
    /**
     * One:One relationship between tourguide_claims & guide_income_products
     */
    public function claims()
    {
        return $this->belongsTo('App\Models\TourguideClaims',"tour_guide_claim_id","id");
    }
    
    /* Insert/ Update/ Delete Expenses Taxis
     * 
     * @params object $claimModel, array $expensesTaxis
     */
    public function updateExpensesTaxis($claimModel, $expensesTaxis){
        
        $aryExpensesTaxis = array();
        
        foreach($expensesTaxis as $key=>$value){
            //if have id, update
            if(!empty($value["id"])){
                $expensesTaxisModel = self::find($value["id"]);
                
            }else{
                $expensesTaxisModel = new GuideExpensesTaxis;
             }
             
             $expensesTaxisModel->amount = $value["amount"];
             $expensesTaxisModel->claim_option_id=  $value["claim_option_id"];
             $expensesTaxisModel->timestamps = false;
             $aryExpensesTaxis[] = $expensesTaxisModel;
        }

        if(count($aryExpensesTaxis)>0){
            $claimModel->expensesTaxis()->saveMany($aryExpensesTaxis);
        }
        
    }
}
