<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuideTicketExpenses extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guide_ticket_expenses';
    
    /**
     * One:One relationship between tourguide_claims & guide_ticket_expenses
     */
    public function claims()
    {
        return $this->belongsTo('App\Models\TourGuideClaims',"tour_guide_claim_id","id");
    }
    
    /**
     * One:One relationship between tickets & guide_ticket_expenses
     */
    public function tickets()
    {
        return $this->belongsTo('App\Models\Tickets',"id","ticket");
    }
    
}
