'use strict'

in_store.controller("InStoreController", ["$scope", "$route", "$http", "$uibModal", "$window", "inStoreModel", "$location", 
    function($scope, $route , $http, $uibModal, $window, inStoreModel, $location) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        console.log('In Store Controller JS', fitBookingId);
}]);