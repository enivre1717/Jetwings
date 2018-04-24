'use strict'

tour_guide.controller("LogoutController", ["$scope", "$route", "$http", "$uibModal", "$window", "tourguideModel", "$location", 
    function($scope, $route, $http, $uibModal, $window, tourguideModel, $location) {
        
        
        tourguideModel.logout()
            .then(function(results){

                if(results.status == 200){

                    if(results.data == true){
                        $location.path("/");
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