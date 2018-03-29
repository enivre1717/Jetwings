<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransportAgencies extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'transport_agencies';
    
    /**
     * One:Many relationship between transport_agencies & fit_transports
     */
    public function fitTransports()
    {
        return $this->hasMany('App\Models\FitTransports',"id");
    }
    
    
}
