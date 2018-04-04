<div ng-controller="CommissionFormController">
    
    <a href="#!/fitbookings/forms/@{{commissions.fit_booking_id}}" class="btn btn-info primary-btn">Back</a>
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
                团号 Tour Code: @{{commissions.tour_code}}
            </div>

            <div class="row">
                领队 Tour Leader: @{{commissions.tour_leader}}
            </div>

            <div class="row">
                导游 Tour Guide: @{{commissions.tour_guide}}
            </div>

            <div class="row">
                佣金
            </div>

            <div class="row">
                <div class="col-md-1 col-xs-1">1. </div><label>珠宝/纬壹新生科技</label>
                    

                <div class="col-md-2 col-xs-3"></div>

                <div class="col-md-2 col-xs-3">
                    <div class="input-group" ng-show="!hasSubmitted">
                        <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                        <input ng-value="commissions.jewellery_sgd | currency: '' : 2" class="form-control" ng-keyup="calculateTotalSGD(commissions);" type="text" name="jewllerySGD" ng-model="commissions.jewellery_sgd" />
                    </div>
                    <span ng-show="hasSubmitted">@{{commissions.jewellery_sgd!= null ? commissions.jewellery_sgd : 0 | currency: '$' : 2}}</span>
                    <div class="clear"></div>
                </div>

                <div class="col-md-2 col-xs-3">
                    <div class="input-group" ng-show="!hasSubmitted">
                        <div class="input-group-addon"><i class="fa fa-jpy"></i></div>
                        <input ng-value="commissions.jewellery_rmb | currency: '' : 2" class="form-control" ng-keyup="calculateTotalRMB(commissions);" type="text" name="jewlleryRMB" ng-model="commissions.jewellery_rmb" />
                    </div>
                    <span ng-show="hasSubmitted">@{{commissions.jewellery_rmb!= null ? commissions.jewellery_rmb : 0 | currency: '' : 2}} RMB</span>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 col-xs-1">2. </div><label>永安堂</label>
                <div class="col-md-2 col-xs-3"></div>
                <div class="col-md-2 col-xs-3">
                    <div class="input-group" ng-show="!hasSubmitted">
                        <div class="input-group-addon" for="$"><i class="fa fa-usd"></i></div>
                        <input ng-value="commissions.yong_ann_sgd | currency: '' : 2" class="form-control" ng-keyup="calculateTotalSGD(commissions);" type="text" name="yongAnnSGD" ng-model="commissions.yong_ann_sgd" />
                    </div>
                    <span ng-show="hasSubmitted">@{{commissions.yong_ann_sgd!= null ? commissions.yong_ann_sgd : 0 | currency: '$' : 2}}</span>
                    <div class="clear"></div>
                </div>

                <div class="col-md-2 col-xs-3">
                    <div class="input-group" ng-show="!hasSubmitted">
                        <div class="input-group-addon" for="$"><i class="fa fa-jpy"></i></div>
                        <input ng-value="commissions.yong_ann_rmb | currency: '' : 2" class="form-control" ng-keyup="calculateTotalRMB(commissions);" type="text" name="yongAnnRMB" ng-model="commissions.yong_ann_rmb" />
                    </div>
                    <span ng-show="hasSubmitted">@{{commissions.yong_ann_rmb!= null ? commissions.yong_ann_rmb : 0 | currency: '' : 2}} RMB</span>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 col-xs-1">3. </div>
                <label class="short">自费项目：</label>
            </div>

            <div class="row optional_items" ng-repeat="items in commissions.commission_items">
                <div class="col-md-1 col-xs-1">&nbsp;</div>

                <div class="col-md-2 col-xs-3">
                    <input ng-show="!hasSubmitted" class="form-control" type="text" name="remarks[]" placeholder="自费项目" ng-model="items.remarks"/>
                    <span ng-show="hasSubmitted">@{{items.remarks}}</span>
                    <div class="clear"></div>
                </div>
                <div class="col-md-2 col-xs-3">
                    <input ng-show="!hasSubmitted" class="form-control" type="text" ng-keyup="calculateTotalRMB(commissions); calculateTotalSGD(commissions);" name="qty[]" placeholder="人数" ng-model="items.qty"/>
                    <span ng-show="hasSubmitted">@{{items.qty}}</span>
                    <div class="clear"></div>
                </div>
                <div class="col-md-2 col-xs-3">
                    <div class="input-group" ng-show="!hasSubmitted">
                        <div class="input-group-addon" for="$"><i class="fa fa-usd"></i></div>
                        <input ng-value="items.sgd | currency: '' : 2" class="form-control" ng-keyup="calculateTotalSGD(commissions);" type="text" name="sgd[]" ng-model="items.sgd"/>
                    </div>
                    <span ng-show="hasSubmitted">@{{items.sgd!= null ? items.sgd : 0 | currency: '$' : 2}}</span>
                    <div class="clear"></div>
                </div>

                <div class="col-md-2 col-xs-3">
                    <div class="input-group" ng-show="!hasSubmitted">
                        <div class="input-group-addon" for="$"><i class="fa fa-jpy"></i></div>
                        <input ng-value="items.rmb | currency: '' : 2" class="form-control" ng-keyup="calculateTotalRMB(commissions);" type="text" name="rmb[]" ng-model="items.rmb"/>
                        <input class="form-control" type="hidden" name="id[]" ng-model="items.id"/>
                    </div>
                    <span ng-show="hasSubmitted">@{{items.rmb!= null ? items.rmb : 0 | currency: '' : 2}} RMB</span>
                    <div class="clear"></div>
                </div>
            </div>
            
            <div class="row" ng-show="!hasSubmitted">
                <button class="btn btn-info primary-btn" ng-click="addAttraction();">添加景点</button>
            </div>

            <div class="row marginTop50 total">
                <div class="col-md-1 col-xs-1"></div>
                <label class="short">合计：</label>
                <div class="col-md-2 col-xs-3"></div>
                <div class="col-md-2 col-xs-3">
                    <div class="input-group" ng-show="!hasSubmitted">
                        <div class="input-group-addon" for="$"><i class="fa fa-usd"></i></div>
                        <input class="form-control" type="text" name="TotalSGD" ng-model="commissions.total_sgd"/>
                    </div>
                    <span ng-show="hasSubmitted">@{{commissions.total_sgd != null ? commissions.total_sgd : 0 | currency: '$' : 2}}</span>
                </div>
                <div class="col-md-2 col-xs-3">
                    <div class="input-group" ng-show="!hasSubmitted">
                        <div class="input-group-addon" for="$"><i class="fa fa-jpy"></i></div>
                        <input class="form-control" type="text" name="TotalRMB" ng-model="commissions.total_rmb"/>
                    </div>
                    <span ng-show="hasSubmitted">@{{commissions.total_rmb != null ? commissions.total_rmb : 0 | currency: '' : 2}} RMB</span>
                </div>
            </div>

            <div class="row marginTop50">
               <div class="col-md-1 col-xs-1"></div>
               <div class="col-md-2 col-xs-3"></div>
               <div class="col-md-2 col-xs-3"></div>
               <div class="col-md-2 col-xs-3">
                   <input ng-show="!hasSubmitted" type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="commissions.sgd_to_company" />
                   <span ng-show="hasSubmitted">@{{commissions.sgd_to_company==1 ? "&#9745;" : "&#9744;"}}</span> 
                   <label>新币对公司</label>
                   
               </div>
               <div class="col-md-2 col-xs-3">
                   <input ng-show="!hasSubmitted" type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="commissions.rmb_to_company" />
                   <span ng-show="hasSubmitted">@{{commissions.rmb_to_company==1 ? "&#9745;" : "&#9744;"}}</span> 
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
                    日期: @{{commissions.date}}
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
                    日期: @{{commissions.date}}
                </div>
            </div>

            <div class="row buttons">
                <button ng-show="!hasSubmitted" class="btn btn-info primary-btn" ng-click="submitForm()">Submit</button>
            </div>

        </form>

    </div><!-- form -->
</div>