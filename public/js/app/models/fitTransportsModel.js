'use strict'
app.factory('fitTransportsModel', function($http, $route){
	
	var obj = {};
	
	obj.getTransportsByBookingId = function(bookingId){
            
            return $http.get(apiUrl+"/fit-transports/"+bookingId);
        };
	
	return obj;

});