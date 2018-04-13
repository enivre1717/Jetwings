'use strict'
app.factory('inStoreModel', function($http, $route){
	
	var obj = {};
	
	obj.submitForm = function(inStore){
            
            var data = {
                "inStore": inStore
            };
            
            return $http.post(apiUrl+"/in-store", data);
        };
	
        
	return obj;

});