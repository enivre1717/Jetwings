'use strict'
app.factory('commonModel', function($http, $route){
	
	var obj = {};
	
	obj.getOtherExpensesClaimOptions = function(fitbookingId){
            
            return $http.get(apiUrl+"/common/other-expenses-claim-options");
        };
	
        return obj;

});