'use strict'

feedback.controller("FeedbackController", ["$scope", "$rootScope", "$route", "$http", "$uibModal", "$window", "feedbackModel", "$location", 
    function($scope, $rootScope, $route, $http, $uibModal, $window, feedbackModel, $location) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        var fitbookings = null;
        $scope.feedback = {};

        $scope.feedback.fitBookingId = fitBookingId;
        $scope.feedback.representative;

        $scope.ratings = [
            { "value": "很好", "en_value": "good" },
            { "value": "好", "en_value": "normal" },
            { "value": "普通", "en_value": "bad" },
            { "value": "差", "en_value": "worst" },
            { "value": "不适用", "en_value": "na" }
        ];

        // Begin Get Fit Booking
        feedbackModel.getBookingDetails(fitBookingId)
            .then(function(results){
                $scope.fitBookings = results.data[0];
                // Begin Get Sale|s Agency Name
                feedbackModel.getSalesAgencyById($scope.fitBookings.sale_agency_id)
                    .then(function(results){
                        // console.log("Sale Agencies",results.data);
                        $scope.saleAgencies = results.data;
                    }).catch(function(error){
                        $scope.saleAgencies = null;
                    });
                // End Sale Agency
            }).catch(function(error){
                console.log("Error occurred in retrieving bookings.");
                return null;
            });
        // End Get Fit Booking

        // Begin Get Restaurants
        feedbackModel.getRestaurants()
            .then(function(results){
                $scope.restaurantlist = results.data;
                
                $scope.restaurantlist.push({
                    "id": 0,
                    "name": "其他"
                });
            }).catch(function(error){
                console.log("Error occurred in retrieving restaurants.");
                return null;
            });
        // End Get Restaurants

        // Form Options
        $scope.feedbackTourguideOptions = feedbackModel.getTourguideStaticFormOpts();
        $scope.feedbackCoachOptions = feedbackModel.getCoachStaticFormOpts();
        $scope.feedbackHotelOptions = feedbackModel.getHotelStaticFormOpts();

        $scope.feedback.restaurants = [];
        $scope.feedback.restaurants.push({"restaurant_id":"", "other_restaurant":"", "rating":"", "class":"fb-restaurant"});

        $scope.feedback.names = [];
        $scope.feedback.names.push({"name":""});

        $scope.addRestaurantFeedback = function(){
            $scope.feedback.restaurants.push({"restaurant_id":"", "other_restaurant":"", "rating":"", "class":"fb-restaurant"});
            console.log($scope.feedback.restaurants);
        };

        $scope.addName = function(){
            $scope.feedback.names.push({"name":""});
            // console.log($scope.feedback.names);
        };

        // Signature Pad
        // Begin SigPad
        $('#Signature').signature({syncField: $("#Signature").next("input") });
        $('#TourLeaderSignature').signature({syncField: $("#TourLeaderSignature").next("input") });
        $('.clearButton a').click( function(e) {
            e.preventDefault();
            $(this).parents(".sigWrapper").find(".sigPad").signature('clear');
            $(this).parents(".sigWrapper").find(".sigPad").next("input").val("");
        });
        // End SigPad

        // LOCAL METHODS
        $scope.handleRadioClick = function (group,opt) {
            // console.log(group, opt.en_value);
            switch(group) {
                case 'tourguide':
                    angular.forEach($scope.feedbackTourguideOptions, function(item) {
                        console.log(group, "."+item.class+"-"+opt.en_value);
                        $("."+item.class+"-"+opt.en_value).prop("checked", true);
                        $("."+item.class+"-"+opt.en_value).attr("checked", true);
                    });
                    break;
                case 'coach':
                    angular.forEach($scope.feedbackCoachOptions, function(item) {
                        console.log(group, "."+item.class+"-"+opt.en_value);
                        $("."+item.class+"-"+opt.en_value).prop("checked", true);
                        $("."+item.class+"-"+opt.en_value).attr("checked", true);
                    });
                    break;
                case 'hotel':
                    angular.forEach($scope.feedbackHotelOptions, function(item) {
                        console.log(group, "."+item.class+"-"+opt.en_value);
                        $("."+item.class+"-"+opt.en_value).prop("checked", true);
                        $("."+item.class+"-"+opt.en_value).attr("checked", true);
                    });
                    break;
                case 'restaurant':
                    angular.forEach($scope.feedback.restaurants, function(item) {
                        console.log(group, "."+item.class+"-"+opt.en_value);
                        $("."+item.class+"-"+opt.en_value).prop("checked", true);
                        $("."+item.class+"-"+opt.en_value).attr("checked", true);
                    });
                    break;
            } 
        };

        $scope.submitForm = function(feedback){
            
            $scope.feedback.signature = $("#feedback_signature").val();
            $scope.feedback.tourLeaderSignature = $("#feedback_tour_leader_signature").val();

            $scope.feedback.tour_guide_services = $("input[type=radio][name='tour_guide_services']:checked").val();
            $scope.feedback.tour_guide_attire = $("input[type=radio][name='tour_guide_attire']:checked").val();
            $scope.feedback.tour_guide_attraction = $("input[type=radio][name='tour_guide_attraction']:checked").val();
            $scope.feedback.tour_guide_optional = $("input[type=radio][name='tour_guide_optional']:checked").val();
            $scope.feedback.tour_guide_shopping = $("input[type=radio][name='tour_guide_shopping']:checked").val();
            $scope.feedback.tour_guide_coach = $("input[type=radio][name='tour_guide_coach']:checked").val();

            $scope.feedback.coach_technique = $("input[type=radio][name='coach_technique']:checked").val();
            $scope.feedback.coach_attitude = $("input[type=radio][name='coach_attitude']:checked").val();
            $scope.feedback.coach_aircon = $("input[type=radio][name='coach_aircon']:checked").val();
            $scope.feedback.coach_cleaniness = $("input[type=radio][name='coach_cleaniness']:checked").val();

            $scope.feedback.hotel = $("input[type=radio][name='hotel']:checked").val();

            feedbackModel.submitForm(feedback)
                .then(function(results){
                    
                    //if got error
                    if(typeof results.data.errors !== "undefined" && Object.keys(results.data.errors).length>0){
                            $scope.errors = results.data.errors;
                    }else{
                        // no error
                        if(results.data == "true"){
                            $rootScope.showNotification("自费旅游项目协议书已成功提交。","success");
                        }else{
                            $rootScope.showNotification("自费旅游项目协议书未提交。","error");
                        }
                    
                        $location.path("/fitbookings/forms/"+$scope.feedback.fitBookingId);
                    }
                    
                }).catch(function(error){
                    console.log(error);
                    if(error.status == 401){
                        $location.path("/");
                    }else{
                        console.log("Error occurred in saving feedback form.");
                    }
                });

        };
        
        $scope.isNumber = function(number) {
            if(number != ""){
                return true;
            }else{
                return false;
            }
        };
}]);