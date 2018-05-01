<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Feedback;

class FeedbackController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function submitForm(Request $request){
        try{
            $aryResponse=array();
            $statusCode=config("app.status_code.OK");
            
            $data = json_decode($request->getContent(), true);
            
            $validator = Validator::make($data["feedback"], [
                'tour_guide_services' => 'required',
                'tour_guide_attire' => 'required',
                'tour_guide_attraction' => 'required',
                'tour_guide_optional' => 'required',
                'tour_guide_shopping' => 'required',
                'tour_guide_coach' => 'required',
                'coach_technique' => 'required',
                'coach_attitude' => 'required',
                'coach_aircon' => 'required',
                'coach_cleaniness' => 'required',
                "hotel" => "required",
                "restaurants.*.restaurant_id" => "required_with:restaurants.*.rating",
                "restaurants.*.rating" => "required_with:restaurants.*.restaurant_id",
                "restaurants.*.other_restaurant" => "required_if:restaurants.*.restaurant_id,0",
                "signature" => "required",
                "tourLeaderSignature" => "required",
                "representative" => "required",
            ],[
                'tour_guide_services.required' => '请评服务态度 SERVICES',
                'tour_guide_attire.required' => '请评衣着 ATTIRE',
                'tour_guide_attraction.required' => '请评介绍景点 ATTRACTION INTRO.',
                'tour_guide_optional.required' => '请评推荐自费 OPTIONAL',
                'tour_guide_shopping.required' => '请评介绍购物 SHOPPING',
                'tour_guide_coach.required' => '请评车购 COACH SHOPPING',
                'coach_technique.required' => '请评司机技术 DRIVER\'S TECHNIQUE',
                'coach_attitude.required' => '请评司机服务态度 DRIVER\'S ATTITUDE',
                'coach_aircon.required' => '请评空调 AIR CONDITION',
                'coach_cleaniness.required' => '请评车内整洁 CLEANLINESS',
                "hotel.required" => "请评酒店滿意度 HOTEL SATISFACTION",
                "restaurants.*.restaurant_id.required_with" => "餐厅不能为空!",
                "restaurants.*.rating.required_with" => "请评餐厅!",
                "restaurants.*.other_restaurant.required_if" => "其他餐厅不能为空!",
                "signature.required" => "客人签名不能为空!",
                "tourLeaderSignature.required" => "领队签名不能为空!",
                "representative.required" => "团员代表不能为空!",
                
            ]);
            
            if ($validator->fails()) {
                $aryErrors["errors"] = $validator->errors();
                
                $aryResponse = $aryErrors;
                
            }else{
                $feedbackModel = new Feedback;
                // var_dump($request->input("feedback"));
                // exit;
                $aryResponse = $feedbackModel->submitForm($data["feedback"]);
            }

        }catch(\Exception $e){
            $statusCode=config("app.status_code.Exception");
            $aryResponse["message"] = 'Caught exception: '.$e->getMessage()."\n";
        }
        
        return response()->json($aryResponse, $statusCode);
    }
}