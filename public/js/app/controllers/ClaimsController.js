'use strict'

claims.controller("ClaimsController", ["$scope", "$route", "$location", "$http", "$uibModal", "$window", "claimsModel", "restaurantsModel", "ticketsModel", "commonModel", "attractionsModel", 
    function($scope, $route , $location, $http, $uibModal, $window, claimsModel, restaurantsModel, ticketsModel, commonModel, attractionsModel) {
        
        var fitBookingId = $route.current.params.fitBookingId;
        
        restaurantsModel.getRestaurants()
            .then(function(results){
                
                if(results.data){
                    $scope.restaurants = results.data;
                    
                    $scope.restaurants.push({
                       "id": 0,
                       "name": "Others with GST 其他有消费税"
                    },{
                       "id": 999,
                       "name": "Others without GST 其他无消费税"
                    });
                }else{
                    console.log("There is no restaurant.");
                }
            }).catch(function(error){
                if(error.status == 401){
                    $location.path("/");
                }else{
                    console.log("Error occurred in retrieving restaurants.");
                }
                
            });
            
        ticketsModel.getTickets()
            .then(function(results){
                
                if(results.data){
                    $scope.tickets = results.data;
                    
                    $scope.tickets.push({
                       "id": 0,
                       "ticket": "Other tickets 其他门票"
                    });
                }else{
                    console.log("There is no ticket.");
                }
            }).catch(function(error){
                if(error.status == 401){
                    $location.path("/");
                }else{
                    console.log("Error occurred in retrieving tickets.");
                }
                
            });
            
        commonModel.getOtherExpensesClaimOptions()
            .then(function(results){
                
                if(results.data){
                    $scope.claim_options = results.data;
                }else{
                    console.log("There is no claim options.");
                }
            }).catch(function(error){
                if(error.status == 401){
                    $location.path("/");
                }else{
                    console.log("Error occurred in retrieving claim options.");
                }
                
            });
            
        attractionsModel.getAttractions()
            .then(function(results){
                
                if(results.data){
                    $scope.attractions = results.data;
                }else{
                    console.log("There is no attraction.");
                }
            }).catch(function(error){
                if(error.status == 401){
                    $location.path("/");
                }else{
                    console.log("Error occurred in retrieving attractions.");
                }
                
            });
            
        claimsModel.getAClaim(fitBookingId)
            .then(function(results){
                
                if(results.data){
                    $scope.claim = results.data[0];
                    
                    if($scope.claim.expenses_restaurants.length <=0){
                        $scope.claim.expenses_restaurants = [];
                        $scope.claim.expenses_restaurants.push({
                            "id":"",
                            "restaurant_id":"",
                            "other_restaurant": "",
                            "amount": 0,
                            "claim_option_id": 6
                        });
                    }
                    
                    if($scope.claim.ticket_expenses.length <=0){
                        $scope.claim.ticket_expenses = [];
                        $scope.claim.ticket_expenses.push({
                            "id":"",
                            "ticket": "",
                            "other_ticket": "",
                            "amount": 0,
                            "claim_option_id": 15
                        });
                    }
                    
                    if($scope.claim.other_expenses.length <=0){
                        $scope.claim.other_expenses = [];
                        $scope.claim.other_expenses.push({
                            "id":"",
                            "expenses": "",
                            "other_expenses": "",
                            "amount": 0,
                            "claim_option_id": 15
                        });
                        
                        $scope.claim.other_expenses.push({
                            "id":"",
                            "expenses": "",
                            "other_expenses": "",
                            "amount": 0,
                            "claim_option_id": ""
                        });
                    }else{
                        var hasOld = false;
                        var hasOtherExpenses = false;
                        
                        angular.forEach($scope.claim.other_expenses, function(v, k){
                            if(v.claim_option_id == 15){
                                hasOld = true;
                            }else if(v.claim_option_id > 15){
                                hasOtherExpenses = true;
                            }
                        });
                        
                        if(!hasOld){
                            $scope.claim.other_expenses = [];
                            $scope.claim.other_expenses.push({
                                "id":"",
                                "expenses": "",
                                "other_expenses": "",
                                "amount": 0,
                                "claim_option_id": 15
                            });
                        }
                        
                        if(!hasOtherExpenses){
                            $scope.claim.other_expenses.push({
                                "id":"",
                                "expenses": "",
                                "other_expenses": "",
                                "amount": 0,
                                "claim_option_id": ""
                            });
                        }
                    }
                    
                    if($scope.claim.income_owns.length <=0){
                        $scope.claim.income_owns = [];
                        $scope.claim.income_owns.push({
                            "id":"",
                            "attraction_id": "",
                            "other_attraction": "",
                            "selling_price": 0,
                            "tl_cost": 0,
                            "tg_cost": 0,
                            "fee": 0,
                            "qty": 0,
                            "claim_option_id": 2,
                            "total": 0
                        });
                    }
        
                }else{
                    console.log("Tour guide claim is empty.");
                }
            }).catch(function(error){
                if(error.status == 401){
                    $location.path("/");
                }else{
                    console.log("Error occurred in retrieving tour guide claim.");
                }
                
            });
            
        $scope.addRestaurant = function(){
            
            $scope.claim.expenses_restaurants.push({
                "id":"",
                "restaurant_id":"",
                "other_restaurant": "",
                "amount": 0,
                "claim_option_id": 6
            });
            
        };
        
        $scope.addTickets = function(){
            $scope.claim.ticket_expenses.push({
                "id":"",
                "ticket": "",
                "other_ticket": "",
                "amount": 0,
                "claim_option_id": 15
            });
        };
        
        $scope.addOtherExpenses = function(){
            
            $scope.claim.other_expenses.push({
                "id":"",
                "expenses": "",
                "other_expenses": "",
                "amount": 0,
                "claim_option_id": ""
            });
        };
        
        $scope.addIncomeOwn = function(){
            
            $scope.claim.income_owns.push({
                "id":"",
                "attraction_id": "",
                "other_attraction": "",
                "selling_price": 0,
                "tl_cost": 0,
                "tg_cost": 0,
                "fee": 0,
                "qty": 0,
                "claim_option_id": 2,
                "total": 0
            });
        };
        
        $scope.calTotalIncome = function(income){
            
            income.total = income.qty*(income.selling_price-income.tl_cost-income.tg_cost);
            
        };
        
        $scope.greaterThan = function(prop, val){
            return function(item){
                
              return item[prop] == "" || item[prop] > val;
            }
        };
          
}]);