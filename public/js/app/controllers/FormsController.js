'use strict'

forms.controller("FormsController", ["$scope", "$route", "$location", "$http", "$uibModal", "$window", "fitbookingsModel", 
    function($scope, $route , $location, $http, $uibModal, $window, fitbookingsModel) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        
        fitbookingsModel.getBookingDetails(fitBookingId)
            .then(function(results){
                
                if(results.data){
                    $scope.bookingDetails = results.data[0];
            
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
            
        fitbookingsModel.check2ndCall(fitBookingId)
            .then(function(results){
                
                if(results.data){
                    $scope.has2ndCall = results.data[0];
            
                }else{
                    console.log("Error occurred in retrieving 2nd call.");
                }
            }).catch(function(error){
                if(error.status == 401){
                    $location.path("/");
                }else{
                    console.log("Error occurred in retrieving 2nd call.");
                }
                
            });
}]);