'use strict'
app.factory('safetyContractsModel', function($http, $route){
	
	var obj = {};
	
	obj.submitForm = function(contract){
            
            var data={
                "contract": contract
            };
            
            return $http.post(apiUrl+"/safety-contracts", data);
        };
	
        
	return obj;

});