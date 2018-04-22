<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideExpensesTips extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guide_expenses_tips';
    
    /**
     * One:One relationship between tourguide_claims & guide_income_products
     */
    public function claims()
    {
        return $this->belongsTo('App\Models\TourGuideClaims',"tour_guide_claim_id","id");
    }
    
    /* Insert/ Update/ Delete Expenses Tips
     * 
     * @params object $claimModel, array $expensesTaxis
     */
    public function updateExpensesTips($claimModel, $expensesTips){
        
        $aryExpensesTips = array();
        
        foreach($expensesTips as $key=>$value){
            //if have id, update
            if(!empty($value["id"])){
                $expensesTipsModel = self::find($value["id"]);
                
            }else{
                $expensesTipsModel = new GuideExpensesTips;
             }
             
             $expensesTipsModel->amount = $value["amount"];
             $expensesTipsModel->claim_option_id=  $value["claim_option_id"];
             $expensesTipsModel->timestamps = false;
             $aryExpensesTips[] = $expensesTipsModel;
        }

        if(count($aryExpensesTips)>0){
            $claimModel->expensesTips()->saveMany($aryExpensesTips);
        }
        
    } 
    
}
