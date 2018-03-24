<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\OwnExpensesAttractions;
use App\Models\OwnExpensesNames;

class OwnExpenses extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'own_expenses_forms';
    
    /**
     * One:Many relationship between own_expenses_forms & own_expenses_form_attractions
     */
    public function attractions()
    {
        return $this->hasMany('App\Models\OwnExpensesAttractions', "own_expenses_form_id");
    }
    
    /**
     * One:Many relationship between own_expenses_forms & own_expenses_form_names
     */
    public function names()
    {
        return $this->hasMany('App\Models\OwnExpensesNames', "own_expenses_form_id");
    }
    
    /* Submit form
     * 
     * @params array from data
     * @return boolean
     */
    public function submitForm($data){
        
        $hasSaved = false;
        $aryAttractions = array();
        $aryNames = array();
        
        $ownExpensesModel = new OwnExpenses;
        
        
        $ownExpensesModel->fit_booking_id = $data['fitBookingId'];
        $ownExpensesModel->representative = $data['representative'];
        $ownExpensesModel->created_by = Auth::id();
        $ownExpensesModel->updated_by = Auth::id();
        
        if($ownExpensesModel->save()){
            
            $hasSaved = true;
            
            foreach($data["attractions"] as $key=>$value){
                $attractionsModel = new OwnExpensesAttractions;
                $attractionsModel->attraction = $value["attraction"];
                $attractionsModel->timestamps = false;
                $aryAttractions[] = $attractionsModel;
            }
            
            foreach($data["names"] as $key=>$value){
                $namesModel = new OwnExpensesNames;
                $namesModel->name = $value["name"];
                $namesModel->timestamps = false;
                $aryNames[] = $namesModel;
            }
            
            $ownExpensesModel->attractions()->saveMany($aryAttractions);
            $ownExpensesModel->names()->saveMany($aryNames);
        }
        
        return $hasSaved;
    }
    
}
