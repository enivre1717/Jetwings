'use strict'
app.factory('fitTransportsModel', function($http, $route){
	
	var obj = {};
	
	obj.getTransportsByBookingId = function(bookingId){
            
            console.log("transport");
            return $http.get(apiUrl+"/fit-transports/fitbookingid/"+bookingId);
        };
	
	return obj;

});