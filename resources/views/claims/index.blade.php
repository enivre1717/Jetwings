<div ng-controller="ClaimsController">
    
    <a href="#!/fitbookings/forms/@{{claims.fit_booking_id}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>
    
    <div class="form">
    
    <div class="header">导游请款单 <span>人数: <?php //print(FitBookings::model()->getNoOfPaxByBookingID($fitBookingID)); ?></span></div>
    <div class="clear"></div>
    
    <form name="form" class="j-forms" novalidate>

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
                <?php
                    //$r=0;
                    //foreach($aryRestaurants as $restaurant){
                ?>
                <tr>
                    <td>
                        <label class="input select">
                            <?php //echo $form->dropDownList($restaurant, "[{$r}]restaurant_id", Restaurants::model()->getRestaurantsNew(),array("class"=>"form-control","empty"=>"- Select -")) ?>
                            <div class="clear"></div>
                            <?php //echo $form->error($restaurant, "[{$r}]restaurant_id") ?>
                            <i></i>
                        </label>
                        <div class="clear"></div>
                        <div class="<?php //print($restaurant->restaurant_id=="0" || $restaurant->restaurant_id=="999" ? "" : "hidden"); ?> marginTop10">
                            <?php //echo $form->textField($restaurant, "[{$r}]other_restaurant",array("class"=>"form-control","placeholder"=>"其他餐厅")) ?>
                            <div class="clear"></div>
                            <?php //echo $form->error($restaurant, "[{$r}]other_restaurant") ?>
                        </div>
                    </td>
                    <td>
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left <?php //print($restaurant->hasErrors("amount") ? "error" : ""); ?>" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($restaurant, "[{$r}]amount",array("class"=>"form-control short","value"=>sprintf("%0.2f",$restaurant->amount))); 
                                  //$TotalExpenses+=$restaurant->amount;
                            ?>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($restaurant, "[{$r}]amount") ?>
                        <?php //echo $form->hiddenField($restaurant, "[{$r}]id") ?>
                    </td>
                </tr>
                <?php   
                            //$r++;
                    //}//foreach
                ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="button" id="add_restaurant" name="add_restaurant" value="Add Item 新增项目" class="btn btn-info" /></td>
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
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left <?php //print($guideFeeModel->hasErrors("amount") ? "error" : ""); ?>" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($guideFeeModel, "amount",array("class"=>"form-control short","value"=>sprintf("%0.2f",$guideFeeModel->amount))); 
                                  //$TotalExpenses+=$guideFeeModel->amount;
                            ?>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideFeeModel, "amount") ?>
                    </td>
                    <td>
                        <?php //$DriverTips=FitBooking::model()->getDriverTipsByBookingID($fitBookingID);?>
                        <?php //printf("$%0.2f",$DriverTips); 
                              //$TotalExpenses+=$DriverTips;
                        ?>
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left <?php //print($driverTipsModel->hasErrors("amount") ? "error" : ""); ?>" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($driverTipsModel, "amount",array("class"=>"form-control short","value"=>sprintf("%0.2f",$driverTipsModel->amount))); 
                                  //$TotalExpenses+=$driverTipsModel->amount;
                            ?>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($driverTipsModel, "Amount"); ?>
                    </td>
                    <td>
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left <?php //print($guideTipsModel->hasErrors("amount") ? "error" : ""); ?>" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($guideTipsModel, "amount",array("class"=>"form-control short","value"=>sprintf("%0.2f",$guideTipsModel->amount))); 
                                //$TotalExpenses+=($guideTipsModel->amount);
                            ?>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideTipsModel, "amount") ?>
                    </td>
                    <td>
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left <?php //print($guideTaxiClaimModel->hasErrors("amount") ? "error" : ""); ?>" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($guideTaxiClaimModel, "amount",array("class"=>"form-control short","value"=>sprintf("%0.2f",$guideTaxiClaimModel->amount))); 
                                  //$TotalExpenses+=($guideTaxiClaimModel->amount);
                            ?>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideTaxiClaimModel, "amount") ?>
                    </td>
                </tr>
            </table>
        </div>
        
        <table class="table blue attraction-expenses">
            <tr>
                <th>门票</th>
                <th>收费</th>
            </tr>
            <?php
                //$o=1;
                //foreach($aryAttractions as $attractionModel){
            ?>
            <tr>
                <td>
                    <label class="input select">
                    <?php //echo $form->dropDownList($attractionModel, "[{$o}]ticket",Tickets::model()->getTicketList(),array("class"=>"form-control short","empty"=>"- Select -")) ?>
                    <div class="clear"></div>
                    <?php //echo $form->error($attractionModel, "[{$o}]ticket") ?>
                    <i></i>
                    </label>
                    <div class="clear"></div>
                    <div class="<?php //print($attractionModel->ticket=="0"? "" : "hidden"); ?> marginTop10">
                        <?php //echo $form->textField($attractionModel, "[{$o}]other_ticket",array("class"=>"form-control","placeholder"=>"其他门票")) ?>
                        <div class="clear"></div>
                        <?php //echo $form->error($attractionModel, "[{$o}]other_ticket") ?>
                    </div>
                </td>
                <td>
                    <div class="widget left-50">
                        <label class="addon adn-50 adn-left <?php //print($attractionModel->hasErrors("amount") ? "error" : ""); ?>" for="$"><i class="fa fa-usd"></i></label>
                        <?php //echo $form->textField($attractionModel, "[{$o}]amount",array("class"=>"form-control short","value"=>sprintf("%.02f",$attractionModel["amount"]))) ?>
                    </div>
                    <div class="clear"></div>
                    <?php //echo $form->error($attractionModel, "[{$o}]amount") ?>
                    <?php //echo $form->hiddenField($attractionModel, "[{$o}]id");?>
                    <?php 
                        //$TotalExpenses+=($attractionModel->amount);    
                    ?>
                </td>
            </tr>
            <?php
                    //$o++;
                //}//foreach
            ?>
            <tr>
                <td>&nbsp;</td>
                <td><input type="button" id="add_others" name="add_others" value="Add Item 新增项目" class="btn btn-info" /></td>
            </tr>
        </table>
    
        <div class="table-responsive">
            <table class="table blue">
            <tr>
                    <th>门票（如之前已输入在旧表格）</th>
                    <th>收费</th>
            </tr>
                <?php
                    //$o=1;
                    //foreach($aryOldAttractions as $attractionModel){
                ?>
            <tr>
                <td>
                        <?php //print($attractionModel->expenses!="" ? $attractionModel->expenses : "&nbsp;"); ?>
                    </td>
                    <td>
                        <?php //printf("$%.2f",$attractionModel->amount); ?>
                    </td>
                </tr>
                    <?php 
                        //$o++;
                    //}//foreach
                    ?>
        </table>
        </div>
    
        <table class="table blue other-expenses">
            <tr>
                <th>其他付费</th>
                <th>费用</th>
            </tr>
            <?php

                //$r=1;
                //foreach($aryOtherExpenses as $otherExpenses){

            ?>
            <tr>
                <td>
                    <label class="input select">
                    <?php //echo $form->dropDownList($otherExpenses,"[Others][{$r}]claim_option_id",  ClaimOptions::model()->getOtherExpensesClaimOptions(),array("class"=>"form-control","empty"=>"- Select -")); ?>
                    <div class="clear"></div>
                        <?php //echo $form->error($otherExpenses, "[Others][{$r}]claim_option_id"); ?>
                        <i></i>
                    </label>
                </td>
                <td>
                    <div class="widget left-50">
                        <label class="addon adn-50 adn-left" for="$"><i class="fa fa-usd"></i></label>
                    <?php //echo $form->textField($otherExpenses, "[Others][{$r}]amount",array("class"=>"form-control short")) ?>
                    </div>
                    <div class="clear"></div>
                    <?php //echo $form->error($otherExpenses, "[Others][{$r}]amount"); ?>
                    <?php //echo $form->hiddenField($otherExpenses, "[Others][{$r}]id");?>
                </td>
            </tr>
            <?php   
                        //$TotalExpenses+=($otherExpenses->amount);
                        //$r++;
                //}//foreach
            ?>
            <tr>
                <td>&nbsp;</td>
                <td><input type="button" id="add_others" name="add_others" value="Add Item 新增项目" class="btn btn-info" /></td>
            </tr>
        </table>
        
        <div class="table-responsive">
            <table class="table yellow own-income">
                <tr>
                    <th colspan="6" class="align-center border-right">自费</th>
                </tr>
                <tr>
                    <td><?php //print(GuideIncomeOwns::model()->getAttributeLabel("attraction_id"));?></td>
                    <td><?php //print(GuideIncomeOwns::model()->getAttributeLabel("qty"));?></td>
                    <td><?php //print(GuideIncomeOwns::model()->getAttributeLabel("selling_price"));?></td>
                    <td><?php //print(GuideIncomeOwns::model()->getAttributeLabel("tl_cost"));?></td>
                    <td><?php //print(GuideIncomeOwns::model()->getAttributeLabel("tg_cost"));?></td>
                    <td>总数额</td>
                </tr>
                <?php 
                    //$o=0;
                    //foreach($aryOwnIncome as $guideOwnIncomeModel){
                ?>
                <tr>
                    <td class="wide-column">
                        <label class="input select">
                            <?php //echo $form->dropDownList($guideOwnIncomeModel, "[{$o}]attraction_id", Attractions::model()->getTickets(),array("class"=>"form-control","empty"=>" - Select -")) ?>
                            <i></i>
                        </label>
                        <div class="clear"></div>
                        <div class="<?php //print($guideOwnIncomeModel->attraction_id=="0" ? "" : "hidden"); ?> marginTop10">
                            <?php //echo $form->textField($guideOwnIncomeModel, "[{$o}]other_attraction",array("class"=>"form-control","placeholder"=>GuideIncomeOwns::model()->getAttributeLabel("other_attraction"))) ?>
                            <div class="clear"></div>
                            <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]other_attraction") ?>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]attraction_id") ?>
                    </td>
                    <td class="width15">
                        <?php //echo $form->textField($guideOwnIncomeModel, "[{$o}]qty",array("class"=>"form-control short")); ?>
                        <div class="clear"></div>
                        <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]qty") ?>
                    </td>
                    <td class="mid-column">
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($guideOwnIncomeModel, "[{$o}]selling_price",array("class"=>"form-control","value"=>sprintf("%.02f",$guideOwnIncomeModel->selling_price))); ?>
                            <div class="clear"></div>
                            <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]selling_price") ?>
                        </div>
                    </td>
                    <td class="mid-column">
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($guideOwnIncomeModel, "[{$o}]tl_cost",array("class"=>"form-control","value"=>sprintf("%.02f",$guideOwnIncomeModel->tl_cost))); ?>
                        <div class="clear"></div>
                            <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]tl_cost") ?>
                        </div>
                    </td>
                    <td class="mid-column">
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($guideOwnIncomeModel, "[{$o}]tg_cost",array("class"=>"form-control","value"=>sprintf("%.02f",$guideOwnIncomeModel->tg_cost))); ?>
                            <div class="clear"></div>
                            <?php //echo $form->error($guideOwnIncomeModel, "[{$o}]tg_cost");
                                  
                                    //$TotalIncome+=($guideOwnIncomeModel->selling_price-$guideOwnIncomeModel->tl_cost-$guideOwnIncomeModel->tg_cost)*$guideOwnIncomeModel->qty;
                            ?>
                        </div>
                    </td>
                    <td class="mid-column">
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left" for="$"><i class="fa fa-usd"></i></label>
                            <input type="text" id="GuideIncomeOwns_<?php //print($o); ?>_Total" name="GuideIncomeOwns[<?php //print($o); ?>][Total]" value="<?php //print(isset($_POST["GuideIncomeOwns"][$o]["Total"]) ? sprintf("%.02f",$_POST["GuideIncomeOwns"][$o]["Total"]) : ""); ?>" class="form-control short" />
                            <?php //echo $form->hiddenField($guideOwnIncomeModel, "[{$o}]id");?>
                        </div>
                    </td>
                </tr>
                <?php 
                        //$o++;
                    //}//foreach 
                ?>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="5"><input type="button" id="add_own_income" name="add_own_income" value="Add Item 添加自费" class="btn btn-info" /></td>
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
                <tr>
                    <td>
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
</div><!-- form -->
</div>