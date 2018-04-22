<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideIncomeOwns extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guide_income_owns';
    
    /**
     * One:One relationship between tourguide_claims & guide_income_products
     */
    public function claims()
    {
        return $this->belongsTo('App\Models\TourGuideClaims',"tour_guide_claim_id","id");
    }
    
    /**
     * One:One relationship between attractions & guide_income_products
     */
    public function attractions()
    {
        return $this->belongsTo('App\Models\Attractions',"attraction_id","id");
    }
    
    /* Insert/ Update/ Delete Income owns
     * 
     * @params object $claimModel, array $incomeOwns
     */
    public function updateIncomeOwns($claimModel, $incomeOwns){
        
        $aryIncomeOwns = array();
        
        foreach($incomeOwns as $key=>$value){
            if(!empty($value["id"])){
                
                $incomeOwnsModel = GuideIncomeOwns::find($value["id"]);
                
                //if id is not empty, attraction_id also not empty
                if(empty($value["attraction_id"])){
                    
                    //update
                    $incomeOwnsModel->attraction_id = $value["attraction_id"];
                    $incomeOwnsModel->other_attraction = $value["other_attraction"];
                    $incomeOwnsModel->selling_price = $value["selling_price"];
                    $incomeOwnsModel->tl_cost = $value["tl_cost"];
                    $incomeOwnsModel->tg_cost = $value["tg_cost"];
                    $incomeOwnsModel->qty = $value["qty"];
                    $incomeOwnsModel->claim_option_id=  $value["claim_option_id"];
                    $incomeOwnsModel->timestamps = false;
                    $aryIncomeOwns[] = $incomeOwnsModel;
                    
                }else{
                    //delete
                    
                    $incomeOwnsModel->delete();
                }
                
            }else{
                
                //if id is empty and attraction_id is not empty
                
                if(!empty($value["attraction_id"])){
                    //insert
                    $incomeOwnsModel = new GuideIncomeOwns;
                    $incomeOwnsModel->attraction_id = $value["attraction_id"];
                    $incomeOwnsModel->other_attraction = $value["other_attraction"];
                    $incomeOwnsModel->selling_price = $value["selling_price"];
                    $incomeOwnsModel->tl_cost = $value["tl_cost"];
                    $incomeOwnsModel->tg_cost = $value["tg_cost"];
                    $incomeOwnsModel->qty = $value["qty"];
                    $incomeOwnsModel->claim_option_id=  $value["claim_option_id"];
                    $incomeOwnsModel->timestamps = false;
                    $aryIncomeOwns[] = $incomeOwnsModel;
                }
            }//if id 
            
        }//foreach
        

        if(count($aryIncomeOwns)>0){
            $claimModel->incomeOwns()->saveMany($aryIncomeOwns);
        }
            
    }
    
}
