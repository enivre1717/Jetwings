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
            
            ownExpenses.signature = $("#signature").val()!= '{"lines":[]}' ? $("#signature").val() : "";
            ownExpenses.tourLeaderSignature = $("#tour_leader_signature").val()!= '{"lines":[]}' ? $("#tour_leader_signature").val() : "";
            
            ownExpensesModel.submitForm(ownExpenses)
                .then(function(results){
                    
                    if(typeof results.data.errors !== "undefined" && Object.keys(results.data.errors).length>0){
                            $scope.errors = results.data.errors;
                    }else{
                            if(results.data == true){
                                $rootScope.showNotification("自费旅游项目协议书已成功提交。","success");
                            }else{
                                $rootScope.showNotification("自费旅游项目协议书未提交。","error");
                            }
                        
                            $location.path("/fitbookings/forms/"+ownExpenses.fitBookingId);
                    }
                        
                }).catch(function(error){
                    if(error.status == 401){
                        $location.path("/");
                    }else{
                        console.log("Error occurred in saving own expenses form.");
                    }
                });
        };
        
        // Begin SigPad
        $('#Signature').signature({syncField: $("#Signature").next("input") });
        $('#TourLeaderSignature').signature({syncField: $("#TourLeaderSignature").next("input") });
        
        $('.clearButton a').click( function(e) {
            e.preventDefault();
            $(this).parents(".sigWrapper").find(".sigPad").signature('clear');
            $(this).parents(".sigWrapper").find(".sigPad").next("input").val("");
        });
        // End SigPad
}]);