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
    
}