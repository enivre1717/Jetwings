'use strict';

var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

var viewUrl = baseUrl+"/public";
var apiUrl = baseUrl+"/public/api";

var app = angular.module('myApp', 
[   "ngRoute", 
    "ui.bootstrap", 
    "ngCookies", 
    'tour_guide', 
    'fit_bookings', 
    'forms', 
    'safety_contracts',
    "own_expenses",
    "in_store",
    "feedback"
]);

var tour_guide = angular.module('tour_guide',["ngRoute"]);
var fit_bookings = angular.module('fit_bookings',["ngRoute"]);
var forms = angular.module('forms',["ngRoute"]);
var safety_contracts = angular.module('safety_contracts',["ngRoute"]);
var own_expenses = angular.module('own_expenses',["ngRoute"]);
var in_store = angular.module('in_store',["ngRoute"]);
var feedback = angular.module('feedback',["ngRoute"]);

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
            templateUrl: viewUrl+'/safety-contract/index',
        })
        .when('/own-expenses/index/:fitBookingId',{
            controller:'OwnExpensesController',
            templateUrl: viewUrl+'/own-expenses/index',
        })
        .when('/in-store/index/:fitBookingId',{
            controller: 'InStoreController',
            templateUrl: viewUrl+'/in-store/index'
        })
        .when('/feedback/index/:fitBookingId',{
            controller: 'FeedbackController',
            templateUrl: viewUrl+'/feedback/index'
        })
        .otherwise("/");
        
    //console.log($cookies.get("apiToken"));
});

app.run(['$http' , "$cookies", "$rootScope", "$location", function($http, $cookies, $rootScope, $location) {
    $http.defaults.headers.common['Authorization'] = $cookies.get("apiToken");
    
    $rootScope.monthList = function() {
        
        var aryMonth = [];
        var strMonth = "";
        
        for(var i =1; i<=12; i++){
            strMonth = ("0" + i).slice(-2);
            aryMonth.push({"value": strMonth, "text": strMonth});
        }
        
        return aryMonth;
    };
    
    $rootScope.todayDate = moment().format("DD/MM/YYYY");
    $rootScope.curYear = moment().format("YYYY");
    $rootScope.curMonth = moment().format("MM");
    $rootScope.curDay = moment().format("DD");
    
    /*$rootScope.$on("$routeChangeStart", function(evt, to, from) {
        // requires authorization?
        console.log(to);
        if (to.authorize === true)
        {
            to.resolve = to.resolve || {};
        }
     });*/

     $rootScope.$on("$routeChangeError", function(evt, to, from, error) {
         if (error.status == 401)
         {
             // redirect to login with original path we'll be returning back to
             $location.path("/");
         }
     });
     
     $rootScope.showNotification = function(msg, type){
         
         $rootScope.msg = msg;
         
         if(type == "error"){
             $rootScope.class = "danger";
         }else{
             $rootScope.class = "success";
         }
         
     };
  
}]);

app.filter("formatDate",function formatDate(){
    return function(text,format){
        return moment(text).format(format);
    }
});

