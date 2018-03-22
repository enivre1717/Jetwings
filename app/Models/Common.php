<?php

namespace App\Models;

class Common{
        
    public static function friendly_long_date($date){
            
        return date("d M Y",strtotime($date));
    }//friendly_long_date

    public static function unfriendly_datetime($datetime){

        return date("Y-m-d H:i:s",strtotime($datetime));
    }//unfriendly_datetime

    public static function unfriendly_date($datetime){

        return date("Y-m-d",strtotime($datetime));
    }//unfriendly_date

    public static function start_of_month(){
        return date("d/m/y", strtotime(date('m').'/01/'.date('y').' 00:00:00'));
    }//start_of_month

    public static function end_of_month(){
        return date("d/m/y", strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('y').' 00:00:00'))));
    }//end_of_month

    public static function unfriendly_short_date($datetime){

        /* Convert user friendly date to mysql date*/
        if($datetime!="" && $datetime!=0){

                $arrDate=explode("/",$datetime); //dd/mm/yy

                $day=$arrDate[0];
                $month=$arrDate[1];
                $year=$arrDate[2];

                return sprintf("%02d-%02d-%02d",$year,$arrDate[1],$arrDate[0]);
        }
    }//unfriendly_short_date
}
