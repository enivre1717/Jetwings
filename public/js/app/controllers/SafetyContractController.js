'use strict'

safety_contracts.controller("SafetyContractController", ["$scope", "$rootScope", "$route", "$location", "$http", "$uibModal", "$window", "fitbookingsModel", "saleAgenciesModel", "safetyContractsModel", 
    function($scope, $rootScope, $route , $location, $http, $uibModal, $window, fitbookingsModel, saleAgenciesModel, safetyContractsModel) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        
        $scope.contract = {};
        
        $scope.monthList = $rootScope.monthList();
        
        $scope.contract.fromDateMonth = $rootScope.curMonth;
        $scope.contract.toDateMonth = $rootScope.curMonth;
        $scope.contract.joinDateMonth = $rootScope.curMonth;
        
        $scope.contract.fromDateYr = $rootScope.curYear;
        $scope.contract.toDateYr = $rootScope.curYear;
        $scope.contract.joinDateYr = $rootScope.curYear;
        
        $scope.contract.fromDateDay = $rootScope.curDay;
        
        $scope.contract.fitBookingId = fitBookingId;
        
        fitbookingsModel.getBookingDetails(fitBookingId)
            .then(function(results){
                
                if(results.data){
                    $scope.bookingDetails = results.data[0];
                    
                    saleAgenciesModel.getSalesAgencyById($scope.bookingDetails.sale_agency_id)
                            .then(function(results){
                                $scope.companyName = results.data.name;
                                
                            }).catch(function(error){
                                if(error.status == 401){
                                    $location.path("/");
                                }else{
                                    console.log("Error occurred in retrieving bookings.");
                                }

                            });
                }else{
                    console.log("Booking details is empty.");
                }
            }).catch(function(error){
                if(error.status == 401){
                    $location.path("/");
                }else{
                    console.log("Error occurred in retrieving bookings.");
                }
                
            });
            
        $scope.submitContract = function(contract){
            
            //retrieve signature
            contract.signature = $("#contract_signature").val();
            
            safetyContractsModel.submitForm(contract)
                  .then(function(results){
                      
                        if(typeof results.data.errors !== "undefined" && Object.keys(results.data.errors).length>0){
                            $scope.errors = results.data.errors;
                        }else{
                            if(results.data == true){
                                $rootScope.showNotification("离团安全责任书已成功提交。","success");
                            }else{
                                $rootScope.showNotification("离团安全责任书未提交。","error");
                            }

                            $location.path("/fitbookings/forms/"+contract.fitBookingId);
                        }
                        
                  }).catch(function(error){
                      
                        if(error.status == 401){
                            $location.path("/");
                        }else{
                            console.log("Error occurred in submitting form.");
                        }

                  });
        };
        
        // Begin SigPad
        $('#Signature').signature({syncField: $("#Signature").next("input") });
        
        $('.clearButton a').click( function(e) {
            e.preventDefault();
            $(this).parents(".sigWrapper").find(".sigPad").signature('clear');
            $(this).parents(".sigWrapper").find(".sigPad").next("input").val("");
        });
        // End SigPad
}]);