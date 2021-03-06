'use strict'
app.factory('fitFlightsModel', function($http, $route){
	
	var obj = {};
	
	obj.getArrivalDetails = function(fitbookingId, callNum){
            
            var data = {
                "fitbookingId": fitbookingId,
                "callNum" : callNum
            };
            
            return $http.post(apiUrl+"/fit-flights/get-arrival-details", data);
        };
	
        
	return obj;

});