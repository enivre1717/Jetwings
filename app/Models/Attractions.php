<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Attractions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'attractions';
    
    /**
     * One:Many relationship between guide_ticket_expenses & tickets
     */
    public function GuideIncomeOwns()
    {
        return $this->hasMany('App\Models\GuideIncomeOwns',"attraction_id");
    }
    
    /* Retrieve all active attractions
     * return array
     */
    
    public function getAttractions(){
        
        $result = self::where([
                    "status" => "Active"
                  ])
                  ->select(["id","name"])
                  ->orderBy("name")
                  ->get();
        
        return $result;
    }
}
