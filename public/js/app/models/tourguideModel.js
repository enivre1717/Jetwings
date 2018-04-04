//'use strict'
app.factory('tourguideModel', function($http){
	
	var obj = {};
	
	obj.login = function(user){
            
            var data = {
              "user": user  
            };
            
            return $http.post(apiUrl+"/login",user);
        };
        
        obj.getTourGuideDetails = function(){
            
            return $http.get(apiUrl+"/me");
            
        };
	
	return obj;

});