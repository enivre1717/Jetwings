<div ng-controller="CommissionFormController">
    
    <a href="#!/fitbookings/forms/@{{arrivalForms.fit_booking_id}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>
    
    <div class="form commission">

        <div class="header">领队佣金单</div>
        <div class="clear"></div>
        <form name="form" class="j-forms">
        
        <?php
        $TotalExpenses = 0;
        $TotalIncome = 0;
        ?>

            <div class="row">
                团号 Tour Code:
                <?php //print($bookingModel[0]->tour_code); ?>
            </div>

            <div class="row">
                领队 Tour Leader:
                <?php //print($bookingModel[0]->tour_leader); ?>
            </div>

            <div class="row">
                导游 Tour Guide:
                <?php //print($tourGuideModel->name); ?>
            </div>

            <div class="row">
                佣金
            </div>

            <div class="row">
                <div class="col-md-1 col-xs-1">1. </div><label>珠宝/纬壹新生科技</label>
                    

                <div class="col-md-2 col-xs-3"></div>

                <div class="col-md-2 col-xs-3">
                    <div class="widget left-50">
                        <label class="addon adn-50 adn-left" for="$"><i class="fa fa-usd"></i></label>
                        <?php //echo $form->textField($commissionModel, "jewellery_sgd",array("class"=>"form-control"));?>
                    </div>
                    <div class="clear"></div>
                    <?php //echo $form->error($commissionModel, "jewellery_sgd"); ?>
                </div>

                <div class="col-md-2 col-xs-3">
                    <div class="widget left-50">
                        <label class="addon adn-50 adn-left" for="$"><i class="fa fa-jpy"></i></label>
                        <?php //echo $form->textField($commissionModel, "jewellery_rmb",array("class"=>"form-control"));?>
                    </div>
                    <div class="clear"></div>
                    <?php //echo $form->error($commissionModel, "jewellery_rmb"); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 col-xs-1">2. </div><label>永安堂</label>
                <div class="col-md-2 col-xs-3"></div>
                <div class="col-md-2 col-xs-3">
                    <div class="widget left-50">
                        <label class="addon adn-50 adn-left" for="$"><i class="fa fa-usd"></i></label>
                        <?php //echo $form->textField($commissionModel, "yong_ann_sgd",array("class"=>"form-control"));?>
                    </div>
                    <div class="clear"></div>
                    <?php //echo $form->error($commissionModel, "yong_ann_sgd"); ?>
                </div>

                <div class="col-md-2 col-xs-3">
                    <div class="widget left-50">
                        <label class="addon adn-50 adn-left" for="$"><i class="fa fa-jpy"></i></label>
                        <?php //echo $form->textField($commissionModel, "yong_ann_rmb",array("class"=>"form-control"));?>
                    </div>
                    <div class="clear"></div>
                    <?php //echo $form->error($commissionModel, "yong_ann_rmb"); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 col-xs-1">3. </div>
                <label class="short">自费项目：</label>
            </div>

            <?php 
                //$c=0;
                //foreach($aryCommissionItem as $commissionItemModel){
            ?>
            <div class="row optional_items">
                <div class="col-md-1 col-xs-1">&nbsp;</div>

                <div class="col-md-2 col-xs-3">
                    <?php //echo $form->textField($commissionItemModel, "[{$c}]remarks",array("class"=>"form-control","placeholder"=>  TourguideCommissionItems::model()->getAttributeLabel("remarks")));?>
                    <div class="clear"></div>
                    <?php //echo $form->error($commissionItemModel, "[{$c}]remarks"); ?>
                </div>
                <div class="col-md-2 col-xs-3">
                    <?php //echo $form->textField($commissionItemModel, "[{$c}]qty",array("class"=>"form-control","placeholder"=>TourguideCommissionItems::model()->getAttributeLabel("qty")));?>
                    <div class="clear"></div>
                    <?php //echo $form->error($commissionItemModel, "[{$c}]qty"); ?>
                </div>
                <div class="col-md-2 col-xs-3">
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left" for="$"><i class="fa fa-usd"></i></label>
                            <?php //echo $form->textField($commissionItemModel, "[{$c}]sgd",array("class"=>"form-control"));?>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($commissionItemModel, "[{$c}]sgd"); ?>
                    </div>

                <div class="col-md-2 col-xs-3">
                        <div class="widget left-50">
                            <label class="addon adn-50 adn-left" for="$"><i class="fa fa-jpy"></i></label>
                            <?php //echo $form->textField($commissionItemModel, "[{$c}]rmb",array("class"=>"form-control"));?>
                        </div>
                        <div class="clear"></div>
                        <?php //echo $form->error($commissionItemModel, "[{$c}]rmb"); ?>
                    </div>
            </div>
            <?php 
                    //$c++;
                //}//foreach
            ?>

            <div class="row">
               <?php //echo CHTML::button("添加景点",array("class" => "btn btn-info primary-btn","id"=>"add_item")); ?> 
            </div>

            <div class="row marginTop50 total">
                <div class="col-md-1 col-xs-1"></div>
                <label class="short">合计：</label>
                <div class="col-md-2 col-xs-3"></div>
                <div class="col-md-2 col-xs-3">
                    <div class="widget left-50">
                        <label class="addon adn-50 adn-left" for="$"><i class="fa fa-usd"></i></label>
                        <input type="text" class="form-control" id="TourguideCommission_Total" name="TourguideCommissions[total]" value="<?php printf("%.02f",isset($_POST["TourguideCommissions"]["total"]) ? $_POST["TourguideCommissions"]["total"] : "0");?>" />
                    </div>
                </div>
                <div class="col-md-2 col-xs-3">
                    <div class="widget left-50">
                        <label class="addon adn-50 adn-left" for="$"><i class="fa fa-jpy"></i></label>
                        <input type="text" class="form-control" id="TourguideCommission_RMBTotal" name="TourguideCommissions[rmb_total]" value="<?php printf("%.02f",isset($_POST["TourguideCommissions"]["rmb_total"]) ? $_POST["TourguideCommissions"]["rmb_total"] : "0");?>" />
                    </div>
                </div>
            </div>

            <div class="row marginTop50">
               <div class="col-md-1 col-xs-1"></div>
               <div class="col-md-2 col-xs-3"></div>
               <div class="col-md-2 col-xs-3"></div>
               <div class="col-md-2 col-xs-3">
                    <?php //echo $form->checkBox($commissionModel, "sgd_to_company");?>
                   <label>新币对公司</label>
               </div>
               <div class="col-md-2 col-xs-3">
                    <?php //echo $form->checkBox($commissionModel, "rmb_to_company");?>
                   <label>人民币对公司</label>
               </div>
            </div>

            <div class="row marginTop50 signature">
                <div class="col-md-5 col-xs-5">
                    <div class="sigWrapper">
                        <ul class="sigNav">
                          <li class="clearButton"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="clear"></div>
                        <div class="sigPad <?php //print($commissionModel->getError("tour_leader_signature")!="" ? "error" : ""); ?>" id="TourLeaderSignature"></div>
                        <?php //echo $form->hiddenField($commissionModel,'tour_leader_signature',array("class"=>"output")); ?>
                    </div>
                    <?php //echo $form->labelEx($commissionModel, "tour_leader_signature",array("class"=>"short"));?>

                    <div class="clear"></div>
                    <?php //echo $form->error($commissionModel, "tour_leader_signature",array("class"=>"marginLeft20 errorMessage")); ?>

                    <div class="clear"></div>
                    <?php //echo $form->labelEx($commissionModel, "Date",array("class"=>"date"));?>:
                    <?php //echo date("d/m/Y");?>
                </div>

                <div class="col-md-5 col-xs-5">
                    <div class="sigWrapper">
                        <ul class="sigNav">
                          <li class="clearButton"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="clear"></div>
                        <div class="sigPad <?php //print($commissionModel->getError("tour_guide_signature")!="" ? "error" : ""); ?>" id="TourGuideSignature"></div>
                        <?php //echo $form->hiddenField($commissionModel,'tour_guide_signature',array("class"=>"output")); ?>
                    </div>
                    <?php //echo $form->labelEx($commissionModel, "tour_guide_signature",array("class"=>"short"));?>

                    <div class="clear"></div>
                    <?php //echo $form->error($commissionModel, "tour_guide_signature",array("class"=>"marginLeft20 errorMessage")); ?>

                    <div class="clear"></div>
                    <?php //echo $form->labelEx($commissionModel, "Date",array("class"=>"date"));?>:
                    <?php //echo date("d/m/Y");?>
                </div>
            </div>

            <div class="row buttons">
                <?php //echo CHtml::submitButton('Submit', array("class" => "btn btn-info primary-btn")); ?>
            </div>

        </form>

    </div><!-- form -->
</div>