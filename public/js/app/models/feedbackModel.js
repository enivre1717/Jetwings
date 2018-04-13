'use strict'
app.factory('feedbackModel', function($http, $route){
	
	var obj = {};
	
	obj.submitForm = function(feedback){
            
            var data = {
                "feedback": feedback
            };
            
            return $http.post(apiUrl+"/feedback", data);
        };
	
        
	return obj;

});