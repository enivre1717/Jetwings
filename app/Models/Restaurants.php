<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Restaurants extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'restaurants';
    
    /**
     * One:Many relationship between guide_expenses_restaurants & restaurants
     */
    public function GuideExpensesRestaurants()
    {
        return $this->hasMany('App\Models\GuideExpensesRestaurants',"restaurant_id");
    }
    
    /* Retrieve all active restaurants
     * return array
     */
    
    public function getRestaurants(){
        
        $result = self::where([
                    "status" => "Active"
                  ])
                  ->select(["id","name","has_gst"])
                  ->orderBy("name")
                  ->get();
        
        return $result;
    }
}
