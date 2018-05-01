<div ng-controller="ClaimsController">
    
    <a href="#!/fitbookings/forms/@{{claim.fit_booking_id}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>
    
    
    <div class="header">导游请款单 <span>人数: <span>@{{claim.fit_bookings.pax_update}}</span></span></div>
    <div class="clear"></div>
    
    <form name="form" class="forms" novalidate>
        
        <div class="row alert alert-danger" ng-show="errors">
            Please fix the following input errors:
            <ul>
                <li ng-repeat="error in errors">@{{error[0]}}</li>
            </ul>
        </div>
        
	<div class="table-responsive">
            <table class="table green restaurant-expenses">
                <tr>
                    <th>餐厅</th>
                    <th>费用</th>
                </tr>
                
                <tr ng-repeat="restaurant in claim.expenses_restaurants">
                    <td>
                        <select ng-show="claim.status != 'Approved'" class="form-control" name="restaurantId[]" ng-model="restaurant.restaurant_id">
                            <option value="undefined">-Select -</option>
                            <option ng-repeat="r in restaurants" ng-value="@{{r.id}}">@{{r.name}}</option>
                        </select>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{restaurant.restaurants.name}}</div>
                        <div class="clear"></div>
                        
                        <div>
                            <input name="otherRestuarant[]" class="form-control @{{errors['expenses_restaurants.'+$index+'.other_restaurant'] ? 'error' : ''}}" ng-show="claim.status != 'Approved' && (restaurant.restaurant_id != undefined && (restaurant.restaurant_id == 0 || restaurant.restaurant_id == 999))" class="form-class" type="text" ng-model ="restaurant.other_restaurant" />
                            <div class="text" ng-show="claim.status == 'Approved'">@{{restaurant.other_restaurant}}</div>
                            <div class="clear"></div>
                        </div>
                    </td>
                    <td>
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon"><i class="fa fa-usd"></i></label>
                            <input type="text" ng-keyup="calTotal(claim);" class="form-control" name="restaurantAmount[]" ng-model="restaurant.amount" ng-value="restaurant.amount.toFixed(2)"/>
                        </div>
                        <div class="text"ng-show="claim.status == 'Approved'">@{{restaurant.amount | currency: '$':2}}</div>
                        <div class="clear"></div>
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td><input ng-show="claim.status != 'Approved'" type="button" ng-click="addRestaurant();" value="Add Item 新增项目" class="btn btn-info" /></td>
                </tr>
            </table>
        </div>
        
        <table class="table green attraction-expenses">
            <tr>
                <th>门票</th>
                <th>收费</th>
            </tr>
            <tr ng-repeat="ticket in claim.ticket_expenses">
                <td>
                    <select ng-show="claim.status != 'Approved'" class="form-control" name="ticket[]" ng-model="ticket.ticket">
                        <option value="undefined">-Select -</option>
                        <option ng-repeat="t in tickets" ng-value="@{{t.id}}">@{{t.ticket}}</option>
                    </select>
                    <div class="text" ng-show="claim.status == 'Approved'">@{{ticket.tickets.ticket}}</div>
                    <div class="clear"></div>
                    <div>
                        <input type="text"  ng-show="claim.status != 'Approved' && ticket.ticket!='undefined' && ticket.ticket == 0" type="text" name="otherTicket[]" class="form-control @{{errors['ticket_expenses.'+$index+'.other_ticket'] ? 'error' : ''}}" ng-model="ticket.other_ticket" />
                        <div class="text" ng-show="claim.status == 'Approved'">@{{ticket.other_ticket}}</div>
                        <div class="clear"></div>
                    </div>
                </td>
                <td>
                    <div ng-show="claim.status != 'Approved'" class="input-group">
                        <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                        <input type="text"  ng-keyup="calTotal(claim);" type="text" class="form-control" name="ticketExpensesAmount[]" ng-model="ticket.amount" ng-value="ticket.amount.toFixed(2)"/>
                    </div>
                    <div class="text" ng-show="claim.status == 'Approved'">@{{ticket.amount | currency: '$':2}}</div>
                    <div class="clear"></div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="text"  ng-show="claim.status != 'Approved'" type="button" ng-click="addTickets();" value="Add Item 新增项目" class="btn btn-info" /></td>
            </tr>
        </table>
        
        <div class="table-responsive">
            <table class="table blue standard-expenses">
                <tr>
                    <th>导游费</th>
                    <!--<th>司机小费</th>-->
                    <th>导游小费</th>
                    <th>的士费</th>
                </tr>

                <tr>
                    <td>
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text"  ng-keyup="calTotal(claim);" type="text" class="form-control" name="guideFeeAmount" ng-model="claim.expenses_fees[0].amount" ng-value="claim.expenses_fees[0].amount.toFixed(2)"/>
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{claim.expenses_fees[0].amount | currency: '$':2}}</div>
                        <div class="clear"></div>
                    </td>
<!--                    <td>
                        <?php //$DriverTips=FitBooking::model()->getDriverTipsByBookingID($fitBookingID);?>
                        <?php //printf("$%0.2f",$DriverTips); 
                              //$TotalExpenses+=$DriverTips;
                        ?>
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" class="form-control" name="driverTipsAmount" ng-model="claim.driver_tips[0].amount" ng-value="claim.driver_tips[0].amount | currency: '': 2"/>
                            <?php //$TotalExpenses+=$driverTipsModel->amount; ?>
                        </div>
                        <div class="clear"></div>
                    </td>-->
                    <td>
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" ng-keyup="calTotal(claim);" type="text" class="form-control" name="guideTipsAmount" ng-model="claim.expenses_tips[0].amount" ng-value="claim.expenses_tips[0].amount.toFixed(2)"/>
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{claim.expenses_tips[0].amount | currency: '$':2}}</div>
                        <div class="clear"></div>
                    </td>
                    <td>
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text"  ng-keyup="calTotal(claim);" type="text" class="form-control" name="guideTaxisAmount" ng-model="claim.expenses_taxis[0].amount" ng-value="claim.expenses_taxis[0].amount.toFixed(2)"/>
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{claim.expenses_taxis[0].amount | currency: '$':2}}</div>
                        <div class="clear"></div>
                    </td>
                </tr>
            </table>
        </div>
        
        <table class="table blue other-expenses">
            <tr>
                <th>其他付费</th>
                <th>费用</th>
            </tr>
            <tr ng-repeat="other_expenses in claim.other_expenses | filter: greaterThan('claim_option_id',15)">
                <td>
                    <select ng-show="claim.status != 'Approved'" class="form-control" name="claimOptionId[]" ng-model="other_expenses.claim_option_id">
                        <option value="">-Select -</option>
                        <option ng-repeat="c in claim_options" ng-value="@{{c.id}}">@{{c.text}}</option>
                    </select>
                    <div class="text" ng-show="claim.status == 'Approved'">@{{getClaimOption(other_expenses.claim_option_id)}}</div>
                </td>
                <td>
                    <div ng-show="claim.status != 'Approved'" class="input-group">
                        <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                        <input type="text"  ng-keyup="calTotal(claim);" type="text" class="form-control" name="otherExpensesAmount[]" ng-model="other_expenses.amount" ng-value="other_expenses.amount.toFixed(2)"/>
                    </div>
                    <div class="text" ng-show="claim.status == 'Approved'">@{{other_expenses.amount | currency: '$':2}}</div>
                    <div class="clear"></div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input ng-show="claim.status != 'Approved'" type="button" ng-click="addOtherExpenses();" value="Add Item 新增项目" class="btn btn-info" /></td>
            </tr>
        </table>
        
        <div class="table-responsive">
            <table class="table yellow own-income">
                <tr>
                    <th colspan="6" class="align-center border-right">自费</th>
                </tr>
                <tr>
                    <td>自费项目</td>
                    <td>人数</td>
                    <td>售价</td>
                    <td>领队佣金/每人</td>
                    <td>导游佣金/每人</td>
                    <td>总数额</td>
                </tr>
                
                <tr ng-repeat="income in claim.income_owns">
                    <td>
                        <select ng-show="claim.status != 'Approved'" class="form-control" name="attractionId[]" ng-model="income.attraction_id">
                            <option value="">-Select -</option>
                            <option ng-repeat="a in attractions" ng-value="@{{a.id}}">@{{a.name}}</option>
                        </select>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{income.attractions.name}}</div>
                        <div class="clear"></div>
                        
                        <div ng-show="income.attraction_id == 999 && claim.status != 'Approved'" class="marginTop10">
                            <input type="text" name="otherAttraction[]" class="form-control" ng-model="income.other_attraction" />
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{income.other_attraction}}</div>
                        <div class="clear"></div>
                        
                    </td>
                    <td>
                        <input type="text" ng-show="claim.status != 'Approved'" ng-keyup="calTotal(claim); calTotalIncome(income);" type="text" name="qty[]" class="form-control" ng-model="income.qty" />
                        <div class="text" ng-show="claim.status == 'Approved'">@{{income.qty}}</div>
                        <div class="clear"></div>
                        
                    </td>
                    <td>
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" ng-keyup="calTotal(claim); calTotalIncome(income);" type="text" class="form-control" name="sellingPrice[]" ng-model="income.selling_price" ng-value="income.selling_price.toFixed(2)"/>
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{income.selling_price | currency: '$':2}}</div>
                        <div class="clear"></div>
                        
                    </td>
                    <td>
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" ng-keyup="calTotal(claim); calTotalIncome(income);" type="text" class="form-control" name="tlCost[]" ng-model="income.tl_cost" ng-value="income.tl_cost.toFixed(2)"/>
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{income.tl_cost | currency: '$':2}}</div>
                        <div class="clear"></div>
                        
                    </td>
                    <td>
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" ng-keyup="calTotal(claim); calTotalIncome(income);" type="text" class="form-control" name="tgCost[]" ng-model="income.tg_cost" ng-value="income.tg_cost.toFixed(2)"/>
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{income.tg_cost | currency: '$':2}}</div>
                        <div class="clear"></div>
                        
                    </td>
                    <td>
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" class="form-control" name="incomeTotal[]" ng-model="income.total" ng-value="income.total.toFixed(2)"/>
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{income.total | currency: '$':2}}</div>
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="5"><input ng-show="claim.status != 'Approved'" type="button" ng-click="addIncomeOwn();" value="Add Item 添加自费" class="btn btn-info" /></td>
                </tr>
            </table>
        </div>
        
        <div class="table-responsive">
            <table class="table yellow income">
                <tr>
                    <th colspan="3" class="align-center border-right">土特产</th>
                </tr>
                <tr>
                    <td>收费（退公司）</td>
                    <td>数额</td>
                    <td class="border-right">总金额</td>
                </tr>
                <tr ng-repeat="product in claim.income_products">
                    <td>
                        <input type="text" ng-show="claim.status != 'Approved'" type="text" ng-keyup="calTotal(claim); calTotalProduct(product);" class="form-control" ng-model="product.fee" ng-value="product.fee.toFixed(2)"/>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{product.fee | currency: '$':2}}</div>
                        <div class="clear"></div>
                        
                    </td>
                    <td>
                        <input type="text" ng-show="claim.status != 'Approved'" type="text" ng-keyup="calTotal(claim); calTotalProduct(product);" class="form-control" ng-model="product.qty" />
                        <div class="text" ng-show="claim.status == 'Approved'">@{{product.qty}}</div>
                        <div class="clear"></div>
                        
                    </td>
                    <td class="border-right">
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" class="form-control" name="productTotal[]" ng-model="product.total" ng-value="product.total.toFixed(2)"/>
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{product.total | currency: '$':2}}</div>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="table-responsive">
            <table class="table yellow other-income">
                <tr>
                    <th>领队佣金（退公司）</th>
                    <th>收费</th>
                </tr>
                
                <tr ng-repeat="other_income in claim.other_incomes">
                    <td>
                        <input type="text" ng-show="claim.status != 'Approved'" type="text" name="income[]" class="form-control" ng-model="other_income.income" />
                        <div class="text" ng-show="claim.status == 'Approved'">@{{other_income.income}}</div>
                        <div class="clear"></div>
                    </td>
                    <td>
                        <div ng-show="claim.status != 'Approved'" class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" ng-keyup="calTotal(claim);" type="text" class="form-control" name="otherIncomeAmount[]" ng-model="other_income.amount" ng-value="other_income.amount.toFixed(2)"/>
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{other_income.amount | currency: '$':2}}</div>
                        <div class="clear"></div>
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td><input ng-show="claim.status != 'Approved'" type="button" ng-click="addOtherIncome();" value="Add Item 新增项目" class="btn btn-info" /></td>
                </tr>
            </table>
        </div>
    
        <div class="table-responsive">
            <table class="table yellow advance-cash">
                <tr>
                    <th colspan="2">预付金 (Advance)</th>
                </tr>

                <tr>
                    <td>
                        <div ng-show="claim.status != 'Approved'" class="input-group" ng-show="claim.status != 'Approved'">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" ng-keyup="calTotal(claim);" type="text" class="form-control" name="advanceCash[]" ng-model="claim.advance_cash" ng-value="claim.advance_cash.toFixed(2)"/>
                        </div>
                        <div class="text" ng-show="claim.status == 'Approved'">@{{claim.advance_cash | currency: '$':2}}</div>
                        <div class="clear"></div>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td><strong>总开支</strong></td>
                    <td>$@{{totalExpenses | currency: '' : 2}}</td>
                </tr>
                <tr>
                    <td><strong>总收入</strong></td>
                    <td>$@{{totalIncome | currency: '' : 2}}</td>
                </tr>
                <tr>
                    <td><strong>预付金</strong></td>
                    <td>$@{{advanceCash | currency: '' : 2}}</td>
                </tr>
                <tr>
                    <td><strong>总数额</strong></td>
                    <td>$@{{balance | currency: '' : 2}}</td>
                </tr>
            </table>
        </div>
        
	<div class="row buttons">
            <input ng-click="submitForm(claim);" ng-show="claim.status != 'Approved'" type="button" class="btn btn-info primary-btn" value="Submit" />
	</div>
       
    </form>
</div>