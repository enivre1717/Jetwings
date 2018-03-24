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
          
          safetyContractsModel.submitForm(contract)
                  .then(function(results){
                      
                        if(results.data == true){
                            $rootScope.showNotification("离团安全责任书已成功提交。","success");
                        }else{
                            $rootScope.showNotification("离团安全责任书未提交。","error");
                        }
                        
                        $location.path("/fitbookings/forms/"+contract.fitBookingId);
                        
                  }).catch(function(error){
                      
                        if(error.status == 401){
                            $location.path("/");
                        }else{
                            console.log("Error occurred in submitting form.");
                        }

                  });
        };
}]);