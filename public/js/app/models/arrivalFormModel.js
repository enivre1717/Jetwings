'use strict'
app.factory('arrivalFormModel', function($http, $route){
	
	var obj = {};
	
	obj.getArrivalFormDetails = function(fitbookingId){
            
            return $http.get(apiUrl+"/arrival-form/"+fitbookingId);
        };
	
        
	return obj;

});