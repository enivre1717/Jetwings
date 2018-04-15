'use strict'
app.factory('inStoreModel', function($http, $route){
	
	var obj = {};
	
	obj.submitForm = function(inStore){
            var data = {
                "inStore": inStore
            };
            // console.log("IN STORE FROM DATA",data);
            return $http.post(apiUrl+"/in-store/submit", data);
        };
	
	return obj;

});