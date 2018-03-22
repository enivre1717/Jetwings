'use strict';

var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

var viewUrl = baseUrl+"/public";
var apiUrl = baseUrl+"/public/api";

var app = angular.module('myApp', ["ngRoute", "ui.bootstrap", "ngCookies", 'tour_guide', 'fit_bookings', 'forms', 'safety_contract']);

var tour_guide = angular.module('tour_guide',["ngRoute"]);
var fit_bookings = angular.module('fit_bookings',["ngRoute"]);
var forms = angular.module('forms',["ngRoute"]);
var safety_contract = angular.module('safety_contract',["ngRoute"]);

app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
          controller:'LoginController',
          templateUrl: viewUrl+'/login',
        })
        .when('/fitbookings/list', {
          controller:'FitBookingsController',
          templateUrl: viewUrl+'/fitbookings/list',
        })
        .when('/fitbookings/forms/:fitBookingId', {
          controller:'FormsController',
          templateUrl: viewUrl+'/fitbookings/forms',
        })
        .when('/safety-contract/index/:fitBookingId',{
            controller:'SafetyContractController',
            templateUrl: viewUrl+'/safetycontract/index',
        });
        
    //console.log($cookies.get("apiToken"));
});

app.run(['$http' , "$cookies", function($http, $cookies) {
    $http.defaults.headers.common['Authorization'] = $cookies.get("apiToken");
}]);

app.filter("formatDate",function formatDate(){
    return function(text,format){
        return moment(text).format(format);
    }
});
