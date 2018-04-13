'use strict'

feedback.controller("FeedbackController", ["$scope", "$route", "$http", "$uibModal", "$window", "feedbackModel", "$location", 
    function($scope, $route , $http, $uibModal, $window, feedbackModel, $location) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        console.log('Feedback Controller JS', fitBookingId);
}]);