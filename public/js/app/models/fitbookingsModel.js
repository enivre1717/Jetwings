'use strict'
app.factory('fitbookingsModel', function($http, $route){
	
	var obj = {};
	
	obj.getBookings = function(filter){
            
            var data = {
                "dateFrom": moment(filter.dateFrom).format("Y-MM-DD"),
                "dateTo": moment(filter.dateTo).format("Y-MM-DD")
            };
            
            return $http.post(apiUrl+"/fitbookings/mine", data);
        };
	
        obj.getBookingDetails = function(fitBookingId){
            
            return $http.get(apiUrl+"/fitbookings/mine/"+fitBookingId);
        };
        
	return obj;

});