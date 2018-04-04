'use strict'

commission_form.controller("CommissionFormController", ["$scope", "$rootScope", "$route", "$location", "$http", "$uibModal", "commissionFormModel", "fitbookingsModel", "tourguideModel", 
    function($scope, $rootScope, $route , $location, $http, $uibModal, commissionFormModel, fitbookingsModel, tourguideModel) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        
        //Retrieve commission details
        commissionFormModel.getCommissionClaimsDetails(fitBookingId)
                .then(function(results){
                    
                    if(results.data.length >0){
                        
                        $scope.commissions = results.data[0];
                        $scope.hasSubmitted = true;
                        $scope.commissions.date = moment().format("DD/MM/YYYY");
                        
                        $scope.commissions.fit_booking_id = results.data[0].fit_bookings.id;
                        $scope.commissions.tour_code = results.data[0].fit_bookings.tour_code;
                        $scope.commissions.tour_leader = results.data[0].fit_bookings.tour_leader;
                        $scope.commissions.tour_guide = results.data[0].tourguides.name;
                        
                        $scope.commissions.total_sgd = calculateTotalSGD($scope.commissions);
                        $scope.commissions.total_rmb = calculateTotalRMB($scope.commissions);
                        
                        if($scope.commissions.commission_items.length <=0){
                            $scope.commissions.commission_items.push({
                                "id": 0,
                                "rmb":0.00,
                                "sgd":0.00,
                                "remarks":"",
                                "tourguide_commission_id": 0,
                                "qty":0,
                            });
                        }
                    }else{
                        
                        $scope.commissions = {};
                        $scope.hasSubmitted = false;
                        $scope.commissions.date = moment().format("DD/MM/YYYY");
                        
                        $scope.commissions.commission_items = [];
                        
                        $scope.commissions.commission_items.push({
                            "id": 0,
                            "rmb":0.00,
                            "sgd":0.00,
                            "remarks":"",
                            "tourguide_commission_id": 0,
                            "qty":0,
                        });
                        
                        //retrieve booking details
                        fitbookingsModel.getBookingDetails(fitBookingId)
                            .then(function(results){
                                
                                if(results.data){
                                    $scope.commissions.fit_booking_id = results.data[0].id;
                                    $scope.commissions.tour_code = results.data[0].tour_code;
                                    $scope.commissions.tour_leader = results.data[0].tour_leader;
                                    
                                    
                                    if(results.data[0].sale_agency_id == 270){
                                        $scope.commissions.sgd_to_company=1;
                                        $scope.commissions.rmb_to_company=1;
                                    }
                                    
                                    //retrieve tour guide details
                                    tourguideModel.getTourGuideDetails()
                                        .then(function(results){
                                            
                                            if(results.data){
                                                $scope.commissions.tour_guide = results.data[0].name;
                                        
                                            }else{
                                               console.log("Error occurred - invalid tour guide."); 
                                            }
                                    
                                        }).catch(function(error){
                                            if(error.status == 401){
                                                $location.path("/");
                                            }else{
                                                console.log("Error occurred in retrieving tour guide details.");
                                            }

                                        });
                                    
                                }else{
                                    console.log("Error occurred - invalid booking.");
                                }
                        
                            }).catch(function(error){
                                if(error.status == 401){
                                    $location.path("/");
                                }else{
                                    console.log("Error occurred in retrieving commission claims details.");
                                }

                            });
                            
                    }
                    
                }).catch(function(error){
                    if(error.status == 401){
                        $location.path("/");
                    }else{
                        console.log("Error occurred in retrieving commission claims details.");
                    }

                });
        
        $scope.addAttraction = function(){
            
            $scope.commissions.commission_items.push({
                            "id": 0,
                            "rmb":0,
                            "sgd":0,
                            "remarks":"",
                            "tourguide_commission_id": 0,
                            "qty":0,
                        });
        };
        
        $scope.calculateTotalSGD = function(commissions){
            $scope.commissions.total_sgd = calculateTotalSGD(commissions);
        };
        
        $scope.calculateTotalRMB = function(commissions){
            $scope.commissions.total_rmb = calculateTotalRMB(commissions);
        };
        
        $scope.submitForm = function(commissions){
            
            commissionFormModel.submitForms(commissions)
                    .then(function(results){
                        if(results.data == true){
                            $rootScope.showNotification("领队佣金单已成功提交。","success");
                        }else{
                            $rootScope.showNotification("领队佣金单未提交。","error");
                        }
                        
                        $location.path("/fitbookings/forms/"+commissions.fit_booking_id);
                        
                    }).catch(function(error){
                        if(error.status == 401){
                            $location.path("/");
                        }else{
                            console.log("Error occurred in submitting commission claim.");
                        }

                    });
        };
        
        function calculateTotalSGD(commissions){
            
            var total = 0;
            var qty = 1;
            
            total += parseFloat(commissions.jewellery_sgd!= null ? commissions.jewellery_sgd : 0);
            total += parseFloat(commissions.yong_ann_sgd!= null ? commissions.yong_ann_sgd : 0);
            
            angular.forEach(commissions.commission_items, function(v,k){
                
                if(v.qty != "" && v.qty != null){
                    qty = v.qty;
                }
                
                total += parseInt(qty)*parseFloat(v.sgd!= null ? v.sgd : 0);
            });
            
            return total.toFixed(2);
        }
        
        function calculateTotalRMB(commissions){
            
            var total = 0;
            var qty = 1;
            
            total += parseFloat(commissions.jewellery_rmb != null ? commissions.jewellery_rmb : 0);
            total += parseFloat(commissions.yong_ann_rmb!= null ? commissions.yong_ann_rmb : 0);
            
            angular.forEach(commissions.commission_items, function(v,k){
                
                if(v.qty != "" && v.qty != null){
                    qty = v.qty;
                }
                
                total += parseInt(qty)*parseFloat(v.rmb!= null ? v.rmb : 0);
            });
            
            return total.toFixed(2);
        }
}]);