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
        return $this->belongsTo('App\Models\Tickets',"ticket","id");
    }
    
    /* Insert/ Update/ Delete Ticket Expenses
     * 
     * @params object $claimModel, array $ticketExpenses
     */
    public function updateTicketExpenses($claimModel, $ticketExpenses){
        
        $aryTicketExpenses = array();
        
        foreach($ticketExpenses as $key=>$value){
            if(!empty($value["id"])){
                
                $ticketExpensesModel = GuideTicketExpenses::find($value["id"]);
                
                //if id is not empty, ticket also not empty
                if(!empty($value["ticket"])){
                    
                    //update
                    $ticketExpensesModel->ticket = $value["ticket"];
                    $ticketExpensesModel->other_ticket = $value["other_ticket"];
                    $ticketExpensesModel->amount = $value["amount"];
                    $ticketExpensesModel->claim_option_id=  $value["claim_option_id"];
                    $ticketExpensesModel->timestamps = false;
                    $aryTicketExpenses[] = $ticketExpensesModel;
                    
                }else{
                    //delete
                    
                    $ticketExpensesModel->delete();
                }
                
            }else{
                
                //if id is empty and ticket is not empty
                
                if(!empty($value["ticket"])){
                    //insert
                    $ticketExpensesModel = new GuideTicketExpenses;
                    $ticketExpensesModel->ticket = $value["ticket"];
                    $ticketExpensesModel->other_ticket = $value["other_ticket"];
                    $ticketExpensesModel->amount = $value["amount"];
                    $ticketExpensesModel->claim_option_id=  $value["claim_option_id"];
                    $ticketExpensesModel->timestamps = false;
                    $aryTicketExpenses[] = $ticketExpensesModel;
                }
            }//if id 
            
        }//foreach
        

        if(count($aryTicketExpenses)>0){
            $claimModel->ticketExpenses()->saveMany($aryTicketExpenses);
        }
            
    }
}
