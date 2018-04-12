<div ng-controller="ClaimsController">
    
    <a href="#!/fitbookings/forms/@{{claim.fit_booking_id}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>
    
    
    <div class="header">导游请款单 <span>人数: <span>@{{claim.fit_bookings.pax_update}}</span></span></div>
    <div class="clear"></div>
    
    <form name="form" class="forms" novalidate>

	<?php 
            $TotalExpenses=0;
            $TotalIncome=0;
            $AdvanceCash=0;
        ?>

    
        <div class="table-responsive">
            <table class="table blue restaurant-expenses">
                <tr>
                    <th>餐厅</th>
                    <th>费用</th>
                </tr>
                
                <tr ng-repeat="restaurant in claim.expenses_restaurants">
                    <td>
                        <select class="form-control" name="restaurantId[]" ng-model="restaurant.restaurant_id">
                            <option value="">-Select -</option>
                            <option ng-repeat="r in restaurants" ng-value="@{{r.id}}">@{{r.name}}</option>
                        </select>
                        <div class="clear"></div>
                        
                        <div>
                            <input name="otherRestuarant[]" class="form-control" ng-show="restaurant.restaurant_id != '' && (restaurant.restaurant_id == 0 || restaurant.restaurant_id == 999)" class="form-class" type="text" ng-model ="restaurant.other_restaurant" />
                            <div class="clear"></div>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <label class="input-group-addon"><i class="fa fa-usd"></i></label>
                            <input class="form-control" name="restuarantAmount[]" ng-model="restaurant.amount" />
                            <?php //$TotalExpenses+=$restaurant->amount;?>
                        </div>
                        <div class="clear"></div>
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="button" ng-click="addRestaurant();" value="Add Item 新增项目" class="btn btn-info" /></td>
                </tr>
            </table>
        </div>
        
        <div class="table-responsive">
            <table class="table blue standard-expenses">
                <tr>
                    <th>导游费</th>
                    <th>司机小费</th>
                    <th>导游小费</th>
                    <th>的士费</th>
                </tr>

                <tr>
                    <td>
                        <div class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" class="form-control" name="guideFeeAmount" ng-model="claim.expenses_fees[0].amount" ng-value="claim.expenses_fees[0].amount | currency: '': 2"/>
                            <?php //$TotalExpenses+=$guideFeeModel->amount; ?>
                        </div>
                        <div class="clear"></div>
                    </td>
                    <td>
                        <?php //$DriverTips=FitBooking::model()->getDriverTipsByBookingID($fitBookingID);?>
                        <?php //printf("$%0.2f",$DriverTips); 
                              //$TotalExpenses+=$DriverTips;
                        ?>
                        <div class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" class="form-control" name="driverTipsAmount" ng-model="claim.driver_tips[0].amount" ng-value="claim.driver_tips[0].amount | currency: '': 2"/>
                            <?php //$TotalExpenses+=$driverTipsModel->amount; ?>
                        </div>
                        <div class="clear"></div>
                    </td>
                    <td>
                        <div class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" class="form-control" name="guideTipsAmount" ng-model="claim.expenses_tips[0].amount" ng-value="claim.expenses_tips[0].amount | currency: '': 2"/>
                            <?php //$TotalExpenses+=$guideTipsModel->amount; ?>
                        </div>
                        <div class="clear"></div>
                    </td>
                    <td>
                        <div class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" class="form-control" name="guideTaxisAmount" ng-model="claim.expenses_taxis[0].amount" ng-value="claim.expenses_taxis[0].amount | currency: '': 2"/>
                            <?php //$TotalExpenses+=$guideTaxiClaimModel->amount; ?>
                        </div>
                        <div class="clear"></div>
                    </td>
                </tr>
            </table>
        </div>
        
        <table class="table blue attraction-expenses">
            <tr>
                <th>门票</th>
                <th>收费</th>
            </tr>
            <tr ng-repeat="ticket in claim.ticket_expenses">
                <td>
                    <select class="form-control" name="ticket[]" ng-model="ticket.ticket">
                        <option value="">-Select -</option>
                        <option ng-repeat="t in tickets" ng-value="@{{t.id}}">@{{t.ticket}}</option>
                    </select>
                    
                    <div class="clear"></div>
                    <div>
                        <input ng-show="ticket.ticket!='' && ticket.ticket == 0" type="text" name="otherTicket[]" class="form-control" ng-model="ticket.other_ticket" />
                        <div class="clear"></div>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                        <input type="text" class="form-control" name="ticketExpensesAmount[]" ng-model="ticket.amount" ng-value="ticket.amount | currency: '': 2"/>
                        <?php //$TotalExpenses+=$attractionModel->amount; ?>
                    </div>
                    <div class="clear"></div>
                    <?php 
                        //$TotalExpenses+=($attractionModel->amount);    
                    ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="button" ng-click="addTickets();" value="Add Item 新增项目" class="btn btn-info" /></td>
            </tr>
        </table>
    
        <table class="table blue other-expenses">
            <tr>
                <th>其他付费</th>
                <th>费用</th>
            </tr>
            <tr ng-repeat="other_expenses in claim.other_expenses | filter: greaterThan('claim_option_id',15)">
                <td>
                    <select class="form-control" name="claimOptionId[]" ng-model="other_expenses.claim_option_id">
                        <option value="">-Select -</option>
                        <option ng-repeat="c in claim_options" ng-value="@{{c.id}}">@{{c.text}}</option>
                    </select>
                </td>
                <td>
                    <div class="input-group">
                        <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                        <input type="text" class="form-control" name="otherExpensesAmount[]" ng-model="other_expenses.amount" ng-value="other_expenses.amount | currency: '': 2"/>
                        <?php //$TotalExpenses+=$attractionModel->amount; ?>
                    </div>
                    <div class="clear"></div><?php //$TotalExpenses+=($otherExpenses->amount); ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="button" ng-click="addOtherExpenses();" value="Add Item 新增项目" class="btn btn-info" /></td>
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
                        <select class="form-control" name="attractionId[]" ng-model="income.attraction_id">
                            <option value="">-Select -</option>
                            <option ng-repeat="a in attractions" ng-value="@{{a.id}}">@{{a.name}}</option>
                        </select>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]attraction_id") ?>
                        
                        <div ng-show="income.attraction_id == 999" class="marginTop10">
                            <input type="text" name="otherAttraction[]" class="form-control" ng-model="income.other_attraction" />
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]other_attraction") ?>
                    </td>
                    <td>
                        <input ng-keyup="calTotalIncome(income);" type="text" name="qty[]" class="form-control" ng-model="income.qty" />
                        <div class="clear"></div>
                        <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]qty") ?>
                    </td>
                    <td>
                        <div class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input ng-keyup="calTotalIncome(income);" type="text" class="form-control" name="sellingPrice[]" ng-model="income.selling_price" ng-value="income.selling_price | currency: '': 2"/>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]selling_price") ?>
                    </td>
                    <td>
                        <div class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input ng-keyup="calTotalIncome(income);" type="text" class="form-control" name="tlCost[]" ng-model="income.tl_cost" ng-value="income.tl_cost | currency: '': 2"/>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]tl_cost") ?>
                    </td>
                    <td>
                        <div class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input ng-keyup="calTotalIncome(income);" type="text" class="form-control" name="tgCost[]" ng-model="income.tg_cost" ng-value="income.tg_cost | currency: '': 2"/>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]tg_cost");
                              //$TotalIncome+=($guideOwnIncomeModel->selling_price-$guideOwnIncomeModel->tl_cost-$guideOwnIncomeModel->tg_cost)*$guideOwnIncomeModel->qty;
                        ?>
                    </td>
                    <td>
                        <div class="input-group">
                            <label class="input-group-addon" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" class="form-control" name="total[]" ng-model="income.total" ng-value="income.total | currency: '': 2"/>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="5"><input type="button" ng-click="addIncomeOwn();" value="Add Item 添加自费" class="btn btn-info" /></td>
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
                        <input type="text" class="form-control" ng-model="product.fee" ng-value="product.fee | currency: '': 2"/>
                        <?php //echo $form->textField($guideProductIncomeModel, "fee",array("class"=>"form-control","value"=>sprintf("%0.2f",$guideProductIncomeModel->fee))) ?>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideProductIncomeModel, "fee") ?>
                    </td>
                    <td>
                        <?php //echo $form->textField($guideProductIncomeModel, "qty",array("class"=>"form-control short")) ?>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideProductIncomeModel, "qty"); 
                              //$TotalIncome+=($guideProductIncomeModel->fee*$guideProductIncomeModel->qty);
                        ?>
                    </td>
                    <td class="border-right">
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" id="GuideIncomeProducts_Total" name="GuideIncomeProducts[Total]" value="<?php //print(isset($_POST["GuideIncomeProducts"]["Total"]) ? sprintf("%.02f",$_POST["GuideIncomeProducts"]["Total"]) : ""); ?>" class="form-control short" />
                        </div>
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
                <?php

                    //$r=0;
                    //foreach($aryOtherIncome as $otherIncome){
                ?>
                <tr>
                    <td>
                        <?php //echo $form->textField($otherIncome, "[{$r}]income",array("class"=>"form-control")) ?>
                        <div class="clear"></div>
                        <?php //echo $form->error($otherIncome, "[{$r}]income") ?>
                    </td>
                    <td>
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left <?php //print($otherIncome->hasErrors("amount") ? "error" : ""); ?>" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($otherIncome, "[{$r}]amount",array("class"=>"form-control short","value"=>sprintf("%.02f",$otherIncome->amount))); $TotalIncome+=$otherIncome->amount; ?>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($otherIncome, "[{$r}]amount") ?>
                        <?php //echo $form->hiddenField($otherIncome, "[{$r}]id");?>
                    </td>
                </tr>
                <?php   
                            //$r++;
                    //}//foreach
                ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="button" id="add_other_income" name="add_other_income" value="Add Item 新增项目" class="btn btn-info" /></td>
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
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left <?php //print($claimModel->hasErrors("advance_cash") ? "error" : ""); ?>" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($claimModel, "advance_cash",array("class"=>"form-control short","value"=>sprintf("%0.2f",$claimModel->advance_cash))); 
                                  //$AdvanceCash+=$claimModel->advance_cash;
                            ?>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($claimModel, "advance_cash") ?>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td><strong>总开支</strong></td>
                    <td>$<span id="TotalExpenses"><?php //printf("%0.2f", $TotalExpenses); ?></span></td>
                </tr>
                <tr>
                    <td><strong>总收入</strong></td>
                    <td>$<span id="TotalIncome"><?php //printf("%0.2f", $TotalIncome); ?></span></td>
                </tr>
                <tr>
                    <td><strong>预付金</strong></td>
                    <td>$<span id="AdvanceCash"><?php //printf("%0.2f", $AdvanceCash); ?></span></td>
                </tr>
                <tr>
                    <td><strong>总数额</strong></td>
                    <td>$<span id="Balance"><?php //printf("%0.2f", $TotalExpenses-$TotalIncome-$AdvanceCash); ?></span></td>
                </tr>
            </table>
        </div>
        
	<div class="row buttons">
                
		<?php //echo CHtml::submitButton('Submit',array("class"=>"btn btn-info primary-btn")); ?>
	</div>
       
    </form>
</div>