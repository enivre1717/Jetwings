'use strict'
app.factory('claimsModel', function($http, $route){
	
	var obj = {};
	
	obj.getAClaim = function(fitbookingId){
            
            return $http.get(apiUrl+"/claims/"+fitbookingId);
        };
	
        obj.submitForms = function(claim){
            
            var data = {
                "claim": claim
            };
            
            return $http.post(apiUrl+"/claims/submit", data);
        };
        
	return obj;

});