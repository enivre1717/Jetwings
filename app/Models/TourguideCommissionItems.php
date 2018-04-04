<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TourguideCommissionItems extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tourguide_commission_items';
    
    /**
     * One:One relationship with tourguide_commissions
     */
    public function commissions()
    {
        return $this->belongsTo('App\Models\TourguideCommissions');
    }
    
}
