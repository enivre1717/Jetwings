<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideIncomeProducts extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guide_income_products';
    
    /**
     * One:One relationship between tourguide_claims & guide_income_products
     */
    public function claims()
    {
        return $this->belongsTo('App\Models\TourGuideClaims',"tour_guide_claim_id","id");
    }
    
    /* Insert/ Update/ Delete Income Products
     * 
     * @params object $claimModel, array $incomeProducts
     */
    public function updateIncomeProducts($claimModel, $incomeProducts){
        
        $aryIncomeProducts = array();
        
        foreach($incomeProducts as $key=>$value){
            if(!empty($value["id"])){
                
                $incomeProductsModel = GuideIncomeProducts::find($value["id"]);
                
                //if id is not empty, fee also not empty
                if(!empty($value["fee"])){
                    
                    //update
                    $incomeProductsModel->fee = $value["fee"];
                    $incomeProductsModel->qty = $value["qty"];
                    $incomeProductsModel->claim_option_id=  $value["claim_option_id"];
                    $incomeProductsModel->timestamps = false;
                    $aryIncomeProducts[] = $incomeProductsModel;
                    
                }else{
                    //delete
                    
                    $incomeProductsModel->delete();
                }
                
            }else{
                
                //if id is empty and fee is not empty
                
                if(!empty($value["fee"])){
                    //insert
                    $incomeProductsModel = new GuideIncomeProducts;
                    $incomeProductsModel->fee = $value["fee"];
                    $incomeProductsModel->qty = $value["qty"];
                    $incomeProductsModel->claim_option_id=  $value["claim_option_id"];
                    $incomeProductsModel->timestamps = false;
                    $aryIncomeProducts[] = $incomeProductsModel;
                }
            }//if id 
            
        }//foreach
        

        if(count($aryIncomeProducts)>0){
            $claimModel->incomeProducts()->saveMany($aryIncomeProducts);
        }
            
    }
    
}
