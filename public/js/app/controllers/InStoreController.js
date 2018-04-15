'use strict'

in_store.controller("InStoreController", ["$scope", "$route", "$http", "$uibModal", "$window", "inStoreModel", "$location", 
    function($scope, $route , $http, $uibModal, $window, inStoreModel, $location) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        console.log('In Store Controller JS', fitBookingId);

        $scope.inStore = {}; 
        $scope.inStore.fitBookingId = fitBookingId;

        $scope.inStore.representative;
        $scope.inStore.signature = $("#Signature").val();
        $scope.inStore.tourLeaderSignature = $("#TourLeaderSignature").val();
        
        $scope.inStore.attractions = [];
        $scope.inStore.attractions.push({"attraction":""});
        
        $scope.inStore.names = [];
        $scope.inStore.names.push({"name":""});
        
        $scope.addAttraction = function(){
            
            $scope.inStore.attractions.push({"attraction":""});
        };
        
        $scope.addName = function(){
            
            $scope.inStore.names.push({"name":""});
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

        $scope.submitForm = function(inStore){
            
            inStoreModel.submitForm(inStore)
                .then(function(results){
                    console.log("SUBMITTED");
                    console.log(inStore);
                }).catch(function(error){
                    if(error.status == 401){
                        $location.path("/");
                    }else{
                        console.log("Error occurred in saving own expenses form.");
                    }
                });

        };
}]);