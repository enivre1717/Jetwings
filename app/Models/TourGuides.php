<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TourGuides extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tour_guides';
    
    /**
     * One:Many relationship with tourguide_commissions
     */
    public function commissions()
    {
        return $this->hasMany('App\Models\TourguideCommissions', "id");
    }
    
    public function authenicateTourGuide($username,$password){
        
        $apiToken="";
        $isAuth=false;
        
        //check if password match in new password field
        if(Auth::attempt(['username' => $username, 'password' => $password])){
            
            $isAuth=true;
        }else{
            //check if password match password field
            $numRecords=self::where([
                ["username","=",$username],
                ["password","=",$password]
            ])->count();
            
            if($numRecords>0){
                $newPassword=bcrypt($password);
                //update the password into new_password field
                $numRecords=self::where([
                    ["username","=",$username],
                    ["password","=",$password]
                ])->update(['new_password' => $newPassword]);
                
                
                if(Auth::attempt(['username' => $username, 'password' => $newPassword])){
                    
                    die("here");
                    $isAuth=true;
                }else{
                    $isAuth=false;
                }
            }else{
                $isAuth=false;
            }
        }//if Auth
        
        if($isAuth){
            
            $user=Auth::user();
            
            //api valid
            $apiValid = Auth::guard("api")->validate(['api_token' => $user->api_token]);
            
            if($apiValid){
                if(empty($user->api_token)){
                    $apiToken=self::updateApiToken($user->id);
                }else{
                    $apiToken=self::getApiToken($user->id);
                }
            }
        }
        
        return $apiToken;
    }
    
    public function logout(){
        Auth::guard("api")->logout();
        
        return true;
    }
    
    public function getApiToken($id){
        $result=self::where([
            ["id","=",$id]
        ])->first(["api_token"]);
        
        return $result->api_token;
    }
    
    public function updateApiToken($id){
        $hasDuplicate=true;
        
        while($hasDuplicate){
            $apiToken= str_random(60);
            
            $numRows=self::where([
                ["api_token","=",$apiToken]
            ])->count();
            
            if($numRows<=0){
                $hasDuplicate=false;
                
                $result=self::where([
                    ["id","=",$id]
                ])->update(['api_token' => $apiToken]);
            }
        }//while
        
        return $apiToken;
    }
    
    public function authApiToken($apiToken){
        
        if(strpos($apiToken,"Bearer")!==false){
            $apiToken=trim(str_replace("Bearer","",$apiToken));
            $user=Auth::guard("api")->user();
            if($user["api_token"]!=$apiToken){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    
    public function getAuthPassword() {
        return $this->new_password;
    }
    
    public function getTourGuideDetails(){
        
        $results = self::where(["id"=>Auth::guard("api")->id()])
                   ->select(["id","name"])->get();
        
        return $results;
    }
}
