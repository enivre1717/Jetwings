<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\InStoreAttractions;
use App\Models\InStoreNames;

class InStore extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'in_store_forms';
    
    /**
     * One:Many relationship between in_store_forms & in_store_form_attractions
     */
    public function attractions()
    {
        return $this->hasMany('App\Models\InStoreAttractions', "in_store_form_id");
    }
    
    /**
     * One:Many relationship between in_store_forms & in_store_form_names
     */
    public function names()
    {
        return $this->hasMany('App\Models\InStoreNames', "in_store_form_id");
    }

    public function submitForm($data){
        
        $hasSaved = false;
        $aryAttractions = array();
        $aryNames = array();

        $inStoreModel = new InStore;
        
        $inStoreModel->fit_booking_id = $data['fitBookingId'];
        $inStoreModel->representative = $data['representative'];
        $inStoreModel->add_remove_attraction = $data['addRemoveAttraction'];
        $inStoreModel->signature = $data['signature'];
        $inStoreModel->tour_leader_signature = $data['tourLeaderSignature'];
        $inStoreModel->created_by = Auth::id();
        $inStoreModel->updated_by = Auth::id();
        
        if($inStoreModel->save()){
            
            $hasSaved = true;
            
            foreach($data["attractions"] as $key=>$value){
                $attractionsModel = new InStoreAttractions;
                $attractionsModel->attraction = $value["attraction"];
                $attractionsModel->timestamps = false;
                $aryAttractions[] = $attractionsModel;
            }
            
            foreach($data["names"] as $key=>$value){
                $namesModel = new InStoreNames;
                $namesModel->name = $value["name"];
                $namesModel->timestamps = false;
                $aryNames[] = $namesModel;
            }
            
            $inStoreModel->attractions()->saveMany($aryAttractions);
            $inStoreModel->names()->saveMany($aryNames);
        }
        
        return $hasSaved;
    }
}
