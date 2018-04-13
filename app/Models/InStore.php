<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        
    }
}
