<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\FeedbackRestaurants;
use App\Models\FeedbackNames;

class Feedback extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'feedbacks';
    
    /**
     * One:Many relationship between feedbacks & feedback_restaurants
     */
    public function restaurants()
    {
        return $this->hasMany('App\Models\FeedbackRestaurants', "feedback_id");
    }
    
    /**
     * One:Many relationship between feedbacks & feedback_names
     */
    public function names()
    {
        return $this->hasMany('App\Models\FeedbackNames', "feedback_id");
    }

    public function submitForm($data){
        
        $hasSaved = false;
        $aryRestaurants = array();
        $aryNames = array();

        $feedbackModel = new Feedback;
        
        $feedbackModel->fit_booking_id = $data['fitBookingId'];
        $feedbackModel->tour_guide_services = $data['tour_guide_services'];
        $feedbackModel->tour_guide_attire = $data['tour_guide_attire'];
        $feedbackModel->tour_guide_attraction = $data['tour_guide_attraction'];
        $feedbackModel->tour_guide_optional = $data['tour_guide_optional'];
        $feedbackModel->tour_guide_shopping = $data['tour_guide_shopping'];
        $feedbackModel->tour_guide_coach = $data['tour_guide_coach'];
        $feedbackModel->coach_technique = $data['coach_technique'];
        $feedbackModel->coach_attitude = $data['coach_attitude'];
        $feedbackModel->coach_aircon = $data['coach_aircon'];
        $feedbackModel->coach_cleaniness = $data['coach_cleaniness'];
        $feedbackModel->hotel = $data['hotel'];
        $feedbackModel->representative = $data['representative'];
        $feedbackModel->remarks = $data['remarks'];
        $feedbackModel->customer_signature = $data['signature'];
        $feedbackModel->tour_leader_signature = $data['tourLeaderSignature'];
        $feedbackModel->created_by = Auth::id();
        $feedbackModel->updated_by = Auth::id();
        
        if($feedbackModel->save()){
            
            $hasSaved = true;
            
            foreach($data["restaurants"] as $key=>$value){
                $feedbackRestaurantsModel = new FeedbackRestaurants;
                $feedbackRestaurantsModel->restaurant_id = $value["restaurant_id"];
                $feedbackRestaurantsModel->rating = $value["rating"];
                $feedbackRestaurantsModel->timestamps = false;
                $aryRestaurants[] = $feedbackRestaurantsModel;
            }
            
            foreach($data["names"] as $key=>$value){
                $namesModel = new FeedbackNames;
                $namesModel->name = $value["name"];
                $namesModel->timestamps = false;
                $aryNames[] = $namesModel;
            }
            
            $feedbackModel->restaurants()->saveMany($aryRestaurants);
            $feedbackModel->names()->saveMany($aryNames);
        }
        
        return $hasSaved;
    }
}
