'use strict'
app.factory('claimsModel', function($http, $route){
	
	var obj = {};
	
	obj.getAClaim = function(fitbookingId){
            
            return $http.get(apiUrl+"/claims/"+fitbookingId);
        };
	
        /*obj.submitForms = function(commissions){
            
            var data = {
                "commissions": commissions
            };
            
            return $http.post(apiUrl+"/commission-form/submit", data);
        };*/
        
	return obj;

});