<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideOtherIncomes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guide_other_incomes';
    
    /**
     * One:One relationship between tourguide_claims & guide_income_products
     */
    public function claims()
    {
        return $this->belongsTo('App\Models\TourGuideClaims',"tour_guide_claim_id","id");
    }
    
    /* Insert/ Update/ Delete Other Incomes
     * 
     * @params object $claimModel, array $otherIncomes
     */
    public function updateOtherIncomes($claimModel, $otherIncomes){
        
        $aryOtherIncomes = array();
        
        foreach($otherIncomes as $key=>$value){
            if(!empty($value["id"])){
                
                $otherIncomesModel = GuideOtherIncomes::find($value["id"]);
                
                //if id is not empty, income also not empty
                if(!empty($value["income"])){
                    
                    //update
                    $otherIncomesModel->income = $value["income"];
                    $otherIncomesModel->amount = $value["amount"];
                    $otherIncomesModel->claim_option_id=  $value["claim_option_id"];
                    $otherIncomesModel->timestamps = false;
                    $aryOtherIncomes[] = $otherIncomesModel;
                    
                }else{
                    //delete
                    
                    $otherIncomesModel->delete();
                }
                
            }else{
                
                //if id is empty and income is not empty
                
                if(!empty($value["income"])){
                    //insert
                    $otherIncomesModel = new GuideOtherIncomes;
                    $otherIncomesModel->income = $value["income"];
                    $otherIncomesModel->amount = $value["amount"];
                    $otherIncomesModel->claim_option_id=  $value["claim_option_id"];
                    $otherIncomesModel->timestamps = false;
                    $aryOtherIncomes[] = $otherIncomesModel;
                }
            }//if id 
            
        }//foreach
        

        if(count($aryOtherIncomes)>0){
            $claimModel->otherIncomes()->saveMany($aryOtherIncomes);
        }
            
    }
}
