'use strict'
app.factory('attractionsModel', function($http, $route){
	
	var obj = {};
	
	obj.getAttractions = function(){
            
            
            return $http.get(apiUrl+"/attractions");
        };
	
        
	return obj;

});