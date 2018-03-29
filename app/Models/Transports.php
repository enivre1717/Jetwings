<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Transports extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'transports';
    
    /**
     * One:Many relationship between fit_transports & transports
     */
    public function fitTransports()
    {
        return $this->hasMany('App\Models\FitTransports');
    }
    
}
