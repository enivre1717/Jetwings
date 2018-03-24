<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleAgencies extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sale_agencies';
    
    /* Returns Company Name
     * 
     * @params int $id
     * @return array
     */
    public function getCompanyNameById($id){
        
        $result=self::find($id)
                ->select("name")
                ->first();
                
        
        return $result;
    }
    
}
