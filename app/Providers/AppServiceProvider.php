<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

use App\Models\SafetyContracts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('checkNric', function ($attribute, $value, $parameters, $validator) {
            
            $results = SafetyContracts::where([
                        "nric"=>$value,
                        "fit_booking_id"=>$parameters[0],
                   ])->count();
            
            if($results > 0){
                return false;
            }else{
                return true;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
