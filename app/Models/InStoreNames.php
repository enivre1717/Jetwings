<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InStoreNames extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'in_store_form_names';
    
    
    public function inStore()
    {
        return $this->belongsTo("App\Models\InStore");
    }
}
