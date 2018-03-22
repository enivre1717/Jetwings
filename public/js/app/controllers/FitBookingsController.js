'use strict'

fit_bookings.controller("FitBookingsController", ["$scope", "$route", "$http", "$uibModal", "$window", "fitbookingsModel", "$location", 
    function($scope, $route , $http, $uibModal, $window, fitbookingsModel, $location) {
        
        //retrieve bookings
        $scope.isDateFromFilterOpened = false;
        $scope.isDateToFilterOpened = false;
        
        var date = new Date();
        var startMonth = new Date(date.getFullYear(), date.getMonth(), 1);
        var endMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0);

        $scope.openDateFromFilter = function(){
            
            if($scope.isDateFromFilterOpened == false){
                $scope.isDateFromFilterOpened = true;
            }else{
                $scope.isDateFromFilterOpened = false;
            }
        };
        
        $scope.openDateToFilter = function(){
            
            if($scope.isDateToFilterOpened == false){
                $scope.isDateToFilterOpened = true;
            }else{
                $scope.isDateToFilterOpened = false;
            }
        };
        
        $scope.filter = {};
        
        $scope.filter.dateFrom = startMonth;
        $scope.filter.dateTo = endMonth;
        
        fitbookingsModel.getBookings($scope.filter)
            .then(function(results){
                $scope.fitbookings = results.data;
        
            }).catch(function(error){
                console.log("Error occurred in retrieving bookings.");
            });
        
        
        
        $scope.filterBookings = function(filter){
            
            fitbookingsModel.getBookings(filter)
            .then(function(results){
                $scope.fitbookings = results.data;
                
            }).catch(function(error){
                console.log("Error occurred in retrieving bookings.");
            });
        };
        
        $scope.fitbookingDetails = function(fitBookingId){
            
            $location.path("/fitbookings/forms/"+fitBookingId);
        };
}]);