<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedbackRestaurants extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'feedback_restaurants';
    
    public function feedbackRestaurants()
    {
        return $this->belongsTo("App\Models\Feedback");
    }

    
}
