'use strict'

tour_guide.controller("LoginController", ["$scope", "$rootScope", "$route", "$http", "$uibModal", "$window", "tourguideModel", "$cookies", "$location", 
    function($scope, $rootScope, $route, $http, $uibModal, $window, tourguideModel, $cookies, $location) {

    $scope.login = function(user){
        
        tourguideModel.login(user)
            .then(function(results){
                
                /*$scope.$modalInstance = $uibModal.open({
                    animation: true,
                    backdrop: 'static',
                    templateUrl: viewUrl+'/notification/success',
                    //size: size,

                });*/
                
                if(results.status == 200){
                    
                    if(typeof results.data.errors !== "undefined" && Object.keys(results.data.errors).length>0){
                        $scope.errors = results.data.errors;
                    }else{
                        $cookies.put("apiToken", "Bearer " + results.data.apiToken);
                        
                        $http.defaults.headers.common['Authorization'] = "Bearer "+results.data.apiToken;
                        $location.path("/fitbookings/list");
                    
                    }
                }else{
                    console.log("Error occurred - unable to login to the app.");
                }

            })
            .catch(function(error){
                console.log(error);
                console.log("Error occurred in angular.");
            });
    };

    $scope.close = function(){
        $scope.$modalInstance.close();
    };

}]);