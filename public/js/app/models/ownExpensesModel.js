'use strict'
app.factory('ownExpensesModel', function($http, $route){
	
	var obj = {};
	
	obj.submitForm = function(ownExpenses){
            
            var data = {
                "ownExpenses": ownExpenses
            };
            
            return $http.post(apiUrl+"/own-expenses/submit", data);
        };
	
        
	return obj;

});