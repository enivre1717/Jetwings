<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideExpensesRestaurants extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guide_expenses_restaurants';
    
    /**
     * One:One relationship between tourguide_claims & guide_expenses_restaurants
     */
    public function claims()
    {
        return $this->belongsTo('App\Models\TourGuideClaims',"tour_guide_claim_id","id");
    }
    
    /**
     * One:One relationship between restaurants & guide_expenses_restaurants
     */
    public function restaurants()
    {
        return $this->belongsTo('App\Models\Restaurants',"restaurant_id","id");
    }
    
}
