<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Tickets extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tickets';
    
    /**
     * One:Many relationship between guide_ticket_expenses & tickets
     */
    public function GuideTicketExpenses()
    {
        return $this->hasMany('App\Models\GuideTicketExpenses',"ticket");
    }
    
    /* Retrieve all active tickets
     * return array
     */
    
    public function getTickets(){
        
        $result = self::where([
                    "status" => "Active"
                  ])
                  ->select(["id","ticket"])
                  ->orderBy("ticket")
                  ->get();
        
        return $result;
    }
}
