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
    "arrival_form",
    "commission_form",
    "claims",
    "in_store",
    "feedback"
]);

var tour_guide = angular.module('tour_guide',["ngRoute"]);
var fit_bookings = angular.module('fit_bookings',["ngRoute"]);
var forms = angular.module('forms',["ngRoute"]);
var safety_contracts = angular.module('safety_contracts',["ngRoute"]);
var own_expenses = angular.module('own_expenses',["ngRoute"]);
var arrival_form = angular.module('arrival_form',["ngRoute"]);
var commission_form = angular.module('commission_form',["ngRoute"]);
var claims = angular.module('claims',["ngRoute"]);
var in_store = angular.module('in_store',["ngRoute"]);
var feedback = angular.module('feedback',["ngRoute"]);

app.config(function($routeProvider, $locationProvider) {
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
        .when('/fitbookings/details/:fitBookingId', {
          controller:'FitBookingsDetailsController',
          templateUrl: viewUrl+'/fitbookings/details',
        })
        .when('/fitbookings/welcome/:fitBookingId', {
          controller:'WelcomeController',
          templateUrl: viewUrl+'/fitbookings/welcome',
        })
        .when('/safety-contracts/index/:fitBookingId',{
            controller:'SafetyContractController',
            templateUrl: viewUrl+'/safety-contracts/index',
        })
        .when('/own-expenses/index/:fitBookingId',{
            controller:'OwnExpensesController',
            templateUrl: viewUrl+'/own-expenses/index',
        })
        .when('/arrival/index/:fitBookingId',{
            controller:'ArrivalFormController',
            templateUrl: viewUrl+'/arrival/index',
        })
        .when('/commissions/index/:fitBookingId',{
            controller:'CommissionFormController',
            templateUrl: viewUrl+'/commissions/index',
        })
        .when('/claims/index/:fitBookingId',{
            controller:'ClaimsController',
            templateUrl: viewUrl+'/claims/index',
        })
        .when('/in-store/index/:fitBookingId',{
            controller: 'InStoreController',
            templateUrl: viewUrl+'/in-store/index'
        })
        .when('/feedback/index/:fitBookingId',{
            controller: 'FeedbackController',
            templateUrl: viewUrl+'/feedback/index'
        })
        .when('/logout',{
            controller: 'LogoutController',
            templateUrl: viewUrl+'/login',
        })
        .otherwise({
            templateUrl: viewUrl+'/errors/404',
        });
        
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
    
    $rootScope.$on("$routeChangeStart", function(evt, to, from) {
        if(typeof $cookies.get("apiToken") !== "undefined" && to.$$route.originalPath == "/"){
            $rootScope.isLoggedIn = true;
            $location.path("/fitbookings/list");
        }
        
        if(typeof $cookies.get("apiToken") != "undefined" && $cookies.get("apiToken")!=""){
            $rootScope.isLoggedIn = true;
        }else{
            $rootScope.isLoggedIn = false;
        }
        
     });

     $rootScope.$on("$routeChangeError", function(evt, to, from, error) {
         if (error.status == 401)
         {
             // redirect to login with original path we'll be returning back to
             $location.path("/");
             $cookies.remove("apiToken");
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
}).filter("html", function html($sce){
    return function(text){
        return $sce.trustAsHtml(text);
    }
});

