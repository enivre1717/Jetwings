'use strict'
app.factory('ticketsModel', function($http, $route){
	
	var obj = {};
	
	obj.getTickets = function(){
            
            
            return $http.get(apiUrl+"/tickets");
        };
	
        
	return obj;

});