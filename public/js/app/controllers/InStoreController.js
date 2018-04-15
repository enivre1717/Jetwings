'use strict'

in_store.controller("InStoreController", ["$scope", "$rootScope", "$route", "$http", "$uibModal", "$window", "inStoreModel", "$location", 
    function($scope, $rootScope, $route , $http, $uibModal, $window, inStoreModel, $location) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        console.log('In Store Controller JS', fitBookingId);

        $scope.inStore = {}; 
        $scope.inStore.fitBookingId = fitBookingId;

        $scope.inStore.representative;
        $scope.inStore.addRemoveAttraction;
        $scope.inStore.signature = $("#InStoreForms_signature").val();
        $scope.inStore.tourLeaderSignature = $("#InStoreForms_tour_leader_signature").val();
        
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
            
            $scope.inStore.signature = $("#InStoreForms_signature").val();
            $scope.inStore.tourLeaderSignature = $("#InStoreForms_tour_leader_signature").val();

            inStoreModel.submitForm(inStore)
                .then(function(results){
                    // console.log("SUBMITTED");
                    // console.log(inStore);
                    console.log(results.data);
                    if(results.data == true){
                        $rootScope.showNotification("自费旅游项目协议书已成功提交。","success");
                    }else{
                        $rootScope.showNotification("自费旅游项目协议书未提交。","error");
                    }
                    
                    $location.path("/fitbookings/forms/"+$scope.inStore.fitBookingId);
                }).catch(function(error){
                    console.log(error);
                    if(error.status == 401){
                        $location.path("/");
                    }else{
                        console.log("Error occurred in saving in-store form.");
                    }
                });

        };
}]);