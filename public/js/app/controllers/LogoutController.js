'use strict'

tour_guide.controller("LogoutController", ["$scope", "$route", "$http", "$uibModal", "$window", "tourguideModel", "$location", "$cookies", 
    function($scope, $route, $http, $uibModal, $window, tourguideModel, $location, $cookies) {
        
        
        tourguideModel.logout()
            .then(function(results){

                if(results.status == 200){

                    if(results.data == true){
                        $location.path("/");
                        $cookies.remove("apiToken");
                    }
                }else{
                    console.log("Error occurred - unable to logout of the app.");
                }

            })
            .catch(function(error){
                console.log(error);
                console.log("Error occurred in angular.");
            });

}]);