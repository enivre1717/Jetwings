'use strict'
app.factory('restaurantsModel', function($http, $route){
	
	var obj = {};
	
	obj.getRestaurants = function(){
            
            
            return $http.get(apiUrl+"/restaurants");
        };
	
        
	return obj;

});