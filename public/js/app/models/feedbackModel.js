'use strict'
app.factory('feedbackModel', function($http, $route){
	
	var obj = {};
    //  ng-model="feedback.tour_guide_attire"
    obj.getTourguideStaticFormOpts = function() {
        var data = [{
            "label": "服务态度 SERVICES",
            "class": "fb-services",
            "name": "tour_guide_services",
            "model": "feedback.tour_guide_services",
        },{
            "label": "衣着 ATTIRE",
            "class": "fb-attire",
            "name": "tour_guide_attire",
            "model": "feedback.tour_guide_attire"
        },{
            "label": "介绍景点 ATTRACTION INTRO",
            "class": "fb-attraction",
            "name": "tour_guide_attraction",
            "model": "feedback.tour_guide_attraction"
        },{
            "label": "推荐自费 OPTIONAL",
            "class": "fb-optional",
            "name": "tour_guide_optional",
            "model": "feedback.tour_guide_optional"
        },{
            "label": "介绍购物 SHOPPING",
            "class": "fb-shopping",
            "name": "tour_guide_shopping",
            "model": "feedback.tour_guide_shopping"
        },{
            "label": "车购 COACH SHOPPING",
            "class": "fb-coachshopping",
            "name": "tour_guide_coach",
            "model": "feedback.tour_guide_coach"
        }];
        return data;
    };

    obj.getCoachStaticFormOpts = function() {
        var data = [{
            "label": "司机技术 DRIVER'S TECHNIQUE",
            "class": "fb-driverstechnique",
            "name": "coach_technique"
        },{
            "label": "司机服务态度 DRIVER'S ATTITUDE",
            "class": "fb-driversattitude",
            "name": "coach_attitude"
        },{
            "label": "空调 AIR CONDITION",
            "class": "fb-aircondition",
            "name": "coach_aircon"
        },{
            "label": "车内整洁 CLEANLINESS",
            "class": "fb-cleanliness",
            "name": "coach_cleaniness"
        }]
        return data;
    };

    obj.getHotelStaticFormOpts = function() {
        var data = [{
            "label": "酒店滿意度 HOTEL SATISFACTION",
            "class": "fb-hotelsatisfaction",
            "name": "hotel"
        }]
        return data;
    };

	obj.submitForm = function(feedback){
        var data = {
            "feedback": feedback
        };
        return $http.post(apiUrl+"/feedback/submit", data);
    };
    
    obj.getBookingDetails = function(fitBookingId){
        return $http.get(apiUrl+"/fitbookings/mine/"+fitBookingId);
    };

    obj.getSalesAgencyById = function(saleAgencyId){
        return $http.get(apiUrl+"/sales-agencies/"+saleAgencyId);
    };

    obj.getRestaurants = function(){
        return $http.get(apiUrl+"/restaurants");
    }
        
	return obj;

});