'use strict'
app.factory('saleAgenciesModel', function($http, $route){
	
	var obj = {};
	
	obj.getSalesAgencyById = function(saleAgencyId){
            
            
            return $http.get(apiUrl+"/sales-agencies/"+saleAgencyId);
        };
	
        
	return obj;

});