'use strict'

arrival_form.controller("ArrivalFormController", ["$scope", "$rootScope", "$route", "$location", "$http", "$uibModal", "arrivalFormModel", "fitFlightsModel", 
    function($scope, $rootScope, $route , $location, $http, $uibModal, arrivalFormModel, fitFlightsModel) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        
        //Retrieve arrival form details
        arrivalFormModel.getArrivalFormDetails(fitBookingId)
                .then(function(results){
                    
                    if(results.data.length >0){
                        
                        $scope.arrivalForms = results.data[0];
                        $scope.hasSubmitted = true;
                    }else{
                        
                        $scope.arrivalForms = {};
                        $scope.hasSubmitted = false;
                        
                        fitFlightsModel.getArrivalDetails(fitBookingId, 2)
                            .then(function(results){

                                if(results.data){
                                    //$scope.bookingDetails = results.data[0];
                                    $scope.arrivalForms.fit_booking_id = results.data[0].id;
                                    $scope.arrivalForms.tour_code = results.data[0].tour_code;
                                    
                                    angular.forEach(results.data[0].calls, function(value,key){
                                        angular.forEach(value.flights, function(v,k){
                                            
                                            if(v.type == "Arrival"){
                                                $scope.arrivalForms.two_nd_arrival = v.flight_no;
                                                $scope.arrivalForms.departure_date = v.arrival_at;
                                                $scope.arrivalForms.arrival_time = v.arrival_at_1!="" ? v.arrival_at_1 : v.arrival_at;
                                            }else if(v.type == "Departure"){
                                                $scope.arrivalForms.departure_flight = v.flight_no;
                                                $scope.arrivalForms.departure_time = v.departure_at_1!="" ? v.departure_at_1 : v.departure_at;
                                            }
                                        });
                                    });
                                }else{
                                    console.log("Invalid booking.");
                                }
                            }).catch(function(error){
                                if(error.status == 401){
                                    $location.path("/");
                                }else{
                                    console.log("Error occurred in retrieving booking details.");
                                }

                            });
                    }
            
                }).catch(function(error){
                    if(error.status == 401){
                        $location.path("/");
                    }else{
                        console.log("Error occurred in retrieving arrival details.");
                    }

                });
        
        
        $scope.submitForm = function(arrivalForms){
            
            arrivalForms.tourGuideSignature = $("#tour_guide_signature").val()!= '{"lines":[]}' ? $("#tour_guide_signature").val() : "";
            arrivalForms.tourLeaderSignature = $("#tour_leader_signature").val()!= '{"lines":[]}' ? $("#tour_leader_signature").val() : "";
            
            arrivalFormModel.submitForms(arrivalForms)
                    .then(function(results){
                        
                        if(typeof results.data.errors !== "undefined" && Object.keys(results.data.errors).length>0){
                            $scope.errors = results.data.errors;
                        }else{
                            if(results.data == "true"){
                                $rootScope.showNotification("二次交接与离新确认书已成功提交。","success");
                            }else{
                                $rootScope.showNotification("二次交接与离新确认书未提交。","error");
                            }

                            $location.path("/fitbookings/forms/"+arrivalForms.fit_booking_id);
                        }
                    
                    }).catch(function(error){
                        if(error.status == 401){
                            $location.path("/");
                        }else{
                            console.log("Error occurred in submitting arrival form.");
                        }

                    });
        };
        
        // Begin SigPad
        $('#TourGuideSignature').signature({syncField: $("#TourGuideSignature").next("input") });
        $('#TourLeaderSignature').signature({syncField: $("#TourLeaderSignature").next("input") });
        $('.clearButton a').click( function(e) {
            e.preventDefault();
            $(this).parents(".sigWrapper").find(".sigPad").signature('clear');
            $(this).parents(".sigWrapper").find(".sigPad").next("input").val("");
        });
        // End SigPad
}]);