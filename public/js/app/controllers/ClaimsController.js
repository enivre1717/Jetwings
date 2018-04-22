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
                    
                    
                    if(typeof $scope.claim == "undefined"){
                        $scope.claim = {};
                        
                        $scope.claim.fit_booking_id = fitBookingId;
                        
                    }
                    
                    $scope.calTotal($scope.claim);
                    
                    if(typeof $scope.claim.expenses_restaurants == "undefined" || $scope.claim.expenses_restaurants.length <=0){
                        $scope.claim.expenses_restaurants = [];
                        $scope.claim.expenses_restaurants.push({
                            "id":"",
                            "restaurant_id": "undefined",
                            "other_restaurant": "",
                            "amount": 0,
                            "claim_option_id": 6
                        });
                    }
                    
                    if(typeof $scope.claim.expenses_fees == "undefined" || $scope.claim.expenses_fees.length <=0){
                        $scope.claim.expenses_fees = [];
                        $scope.claim.expenses_fees.push({
                            "id":"",
                            "amount": 0,
                            "claim_option_id": 7
                        });
                    }
                    
                    if(typeof $scope.claim.expenses_taxis == "undefined" || $scope.claim.expenses_taxis.length <=0){
                        $scope.claim.expenses_taxis = [];
                        $scope.claim.expenses_taxis.push({
                            "id":"",
                            "amount": 0,
                            "claim_option_id": 7
                        });
                    }
                    
                    if(typeof $scope.claim.expenses_tips == "undefined" || $scope.claim.expenses_tips.length <=0){
                        $scope.claim.expenses_tips = [];
                        $scope.claim.expenses_tips.push({
                            "id":"",
                            "amount": 0,
                            "claim_option_id": 7
                        });
                    }
                    
                    if(typeof $scope.claim.ticket_expenses == "undefined" || $scope.claim.ticket_expenses.length <=0){
                        $scope.claim.ticket_expenses = [];
                        $scope.claim.ticket_expenses.push({
                            "id":"",
                            "ticket": "",
                            "other_ticket": "",
                            "amount": 0,
                            "claim_option_id": 15
                        });
                    }
                    
                    if(typeof $scope.claim.other_expenses == "undefined" || $scope.claim.other_expenses.length <=0){
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
                    
                    if(typeof $scope.claim.income_owns == "undefined" ||  $scope.claim.income_owns.length <=0){
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
                    }else{
                        //calculate total
                        
                        angular.forEach($scope.claim.income_owns, function(v,k){
                           $scope.calTotalIncome(v); 
                        });
                    }
                    
                    if(typeof $scope.claim.income_products == "undefined" || $scope.claim.income_products.length <=0){
                        $scope.claim.income_products = [];
                        $scope.claim.income_products.push({
                            "id":"",
                            "fee": "",
                            "qty": "",
                            "claim_option_id": 2,
                            "total": 0
                        });
                    }else{
                        //calculate total
                        
                        angular.forEach($scope.claim.income_products, function(v,k){
                           $scope.calTotalProduct(v);
                        });
                    }
                    
                    if(typeof $scope.claim.other_incomes == "undefined" || $scope.claim.other_incomes.length <=0){
                        $scope.claim.other_incomes = [];
                        $scope.claim.other_incomes.push({
                                "id":"",
                                "income": "",
                                "amount": 0,
                                "claim_option_id": 1
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
                "restaurant_id":"undefined",
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
        
        $scope.addOtherIncome = function(){
            
            $scope.claim.other_incomes.push({
                "id":"",
                "income": "",
                "amount": 0,
                "claim_option_id": 1
            });
        };
        
        $scope.calTotalIncome = function(income){
            
            income.total = parseInt(income.qty)*(parseFloat(income.selling_price)-parseFloat(income.tl_cost)-parseFloat(income.tg_cost));
            
        };
        
        $scope.calTotalProduct = function(product){
            product.total = parseInt(product.qty)*(parseFloat(product.fee));
        };
        
        $scope.greaterThan = function(prop, val){
            return function(item){
                
              return item[prop] == "" || item[prop] > val;
            }
        };
        
        $scope.calTotal = function(claim){
            
            var totalExpenses =0;
            var totalIncome = 0;
            var advanceCash =0;
            var balance = 0;
            
            if(claim){
                //add restaurants
                angular.forEach(claim.expenses_restaurants, function(v,k){
                    totalExpenses += parseFloat(v.amount ? v.amount : 0);
                });

                //add guide tips, taxi, TG fee
                totalExpenses += parseFloat(claim.expenses_fees[0].amount)+ parseFloat(claim.expenses_taxis[0].amount) + parseFloat(claim.expenses_tips[0].amount);

                //add tickets
                angular.forEach(claim.ticket_expenses, function(v,k){
                    totalExpenses += parseFloat(v.amount ? v.amount : 0);
                });

                //add others
                angular.forEach(claim.other_expenses, function(v,k){
                    totalExpenses += parseFloat(v.amount ? v.amount : 0);
                });

                //add own income
                angular.forEach(claim.income_owns, function(v,k){
                    totalIncome += parseFloat(v.total ? v.total : 0);
                    
                });

                //add product income
                angular.forEach(claim.income_products, function(v,k){
                    totalIncome += parseFloat(v.total ? v.total : 0);

                });

                //add other income
                angular.forEach(claim.other_incomes, function(v,k){
                    totalIncome += parseFloat(v.amount ? v.amount : 0);

                });

                advanceCash += parseFloat(claim.advance_cash ? claim.advance_cash : 0);
            }
            
            $scope.totalExpenses = totalExpenses;
            $scope.totalIncome = totalIncome;
            $scope.advanceCash = advanceCash;
            $scope.balance = totalExpenses - totalIncome - advanceCash;
            
            console.log($scope.totalIncome);
        };
        
        $scope.submitForm = function(claim){
            
            claimsModel.submitForms(claim)
                    .then(function(results){
                        
                       if(results.data == true){
                           $rootScope.showNotification("导游请款单已成功提交。","success");
                       }else{
                           $rootScope.showNotification("导游请款单未提交。","error");
                       }
                        
                        $location.path("/fitbookings/forms/"+claim.fit_booking_id);
                        
                    }).catch (function(error){
                        if(error.status == 401){
                            $location.path("/");
                        }else{
                            console.log("Error occurred in submitting tour guide claim.");
                        }
                    });
                        
                        

        };
       
}]);