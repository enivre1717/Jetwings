'use strict'
app.factory('arrivalFormModel', function($http, $route){
	
	var obj = {};
	
	obj.getArrivalFormDetails = function(fitbookingId){
            
            return $http.get(apiUrl+"/arrival-form/"+fitbookingId);
        };
	
        obj.submitForms = function(arrivalForms){
            
            var data = {
                "arrivalForms": arrivalForms
            };
            
            return $http.post(apiUrl+"/arrival-form/submit", data);
        };
        
	return obj;

});