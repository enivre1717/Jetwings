'use strict'

own_expenses.controller("OwnExpensesController", ["$scope", "$rootScope", "$route", "$location", "$http", "$uibModal", "$window", "ownExpensesModel", 
    function($scope, $rootScope, $route , $location, $http, $uibModal, $window, ownExpensesModel) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        
        $scope.ownExpenses = {};
        
        $scope.ownExpenses.fitBookingId = fitBookingId;
        
        $scope.ownExpenses.attractions = [];
        $scope.ownExpenses.attractions.push({"attraction":""});
        
        $scope.ownExpenses.names = [];
        $scope.ownExpenses.names.push({"name":""});
        
        $scope.addAttraction = function(){
            
            $scope.ownExpenses.attractions.push({"attraction":""});
        };
        
        $scope.addName = function(){
            
            $scope.ownExpenses.names.push({"name":""});
        };
        
        $scope.submitForm = function(ownExpenses){
            
            ownExpensesModel.submitForm(ownExpenses)
                .then(function(results){
                    
                    if(results.data == true){
                            $rootScope.showNotification("自费旅游项目协议书已成功提交。","success");
                        }else{
                            $rootScope.showNotification("自费旅游项目协议书未提交。","error");
                        }
                        
                        $location.path("/fitbookings/forms/"+ownExpenses.fitBookingId);
                        
                }).catch(function(error){
                    if(error.status == 401){
                        $location.path("/");
                    }else{
                        console.log("Error occurred in saving own expenses form.");
                    }
                });
        };
}]);