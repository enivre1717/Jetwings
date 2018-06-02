<div ng-controller="CommissionFormController">
    
    <a href="#!/fitbookings/forms/@{{commissions.fit_booking_id}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>
    <div class="loader" ng-show="!dataLoaded"></div>
    <div class="form commission" ng-show="dataLoaded">

        <div class="header">领队佣金单</div>
        <div class="clear"></div>
        <form name="form" class="form-horizontal j-forms">
        
            <div class="row alert alert-danger" ng-show="errors">
                Please fix the following input errors:
                <ul>
                    <li ng-repeat="error in errors">@{{error[0]}}</li>
                </ul>
            </div>
            
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
                <div class="form-group">
                    <label class="col-sm-2 col-xs-2 control-label">1. 珠宝/纬壹新生科技</label>
                    <div class="col-sm-3 col-xs-5">
                      <div class="input-group" ng-show="!hasSubmitted">
                            <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                            <input ng-value="commissions.jewellery_sgd | currency: '' : 2" class="form-control @{{errors.jewellery_sgd ? 'error' : ''}}" ng-keyup="calculateTotalSGD(commissions);" type="text" name="jewllerySGD" ng-model="commissions.jewellery_sgd" />
                      </div>
                      <span ng-show="hasSubmitted">@{{commissions.jewellery_sgd!= null ? commissions.jewellery_sgd : 0 | currency: '$' : 2}}</span>
                    </div>
                    <div class="col-sm-3 col-xs-5">
                        <div class="input-group" ng-show="!hasSubmitted">
                        <div class="input-group-addon"><i class="fa fa-jpy"></i></div>
                        <input ng-value="commissions.jewellery_rmb | currency: '' : 2" class="form-control @{{errors.jewellery_rmb ? 'error' : ''}}" ng-keyup="calculateTotalRMB(commissions);" type="text" name="jewlleryRMB" ng-model="commissions.jewellery_rmb" />
                        </div>
                        <span ng-show="hasSubmitted">@{{commissions.jewellery_rmb!= null ? commissions.jewellery_rmb : 0 | currency: '' : 2}} RMB</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 col-xs-2 control-label">2. 永安堂</label>
                    <div class="col-sm-3 col-xs-5">
                        <div class="input-group" ng-show="!hasSubmitted">
                            <div class="input-group-addon" for="$"><i class="fa fa-usd"></i></div>
                            <input ng-value="commissions.yong_ann_sgd | currency: '' : 2" class="form-control @{{errors.yong_ann_sgd ? 'error' : ''}}" ng-keyup="calculateTotalSGD(commissions);" type="text" name="yongAnnSGD" ng-model="commissions.yong_ann_sgd" />
                        </div>
                        <span ng-show="hasSubmitted">@{{commissions.yong_ann_sgd!= null ? commissions.yong_ann_sgd : 0 | currency: '$' : 2}}</span>
                        <div class="clear"></div>
                    </div>

                <div class="col-sm-3 col-xs-5">
                    <div class="input-group" ng-show="!hasSubmitted">
                        <div class="input-group-addon" for="$"><i class="fa fa-jpy"></i></div>
                        <input ng-value="commissions.yong_ann_rmb | currency: '' : 2" class="form-control @{{errors.yong_ann_rmb ? 'error' : ''}}" ng-keyup="calculateTotalRMB(commissions);" type="text" name="yongAnnRMB" ng-model="commissions.yong_ann_rmb" />
                    </div>
                    <span ng-show="hasSubmitted">@{{commissions.yong_ann_rmb!= null ? commissions.yong_ann_rmb : 0 | currency: '' : 2}} RMB</span>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 col-xs-2 control-label">3. 自费项目:</label>
                </div>
            </div>
            
            <div class="row" ng-repeat="items in commissions.commission_items">
                <div class="form-group">
                    
                    <div class="col-md-2 col-xs-3">
                        <input ng-show="!hasSubmitted" class="form-control" type="text" name="remarks[]" placeholder="自费项目" ng-model="items.remarks"/>
                        <span ng-show="hasSubmitted">@{{items.remarks}}</span>
                        <div class="clear"></div>
                    </div>
                
                    <div class="col-md-3 col-xs-3">
                        <input ng-show="!hasSubmitted" class="form-control" type="text" ng-keyup="calculateTotalRMB(commissions); calculateTotalSGD(commissions);" name="qty[]" placeholder="人数" ng-model="items.qty"/>
                        <span ng-show="hasSubmitted">@{{items.qty}}</span>
                        <div class="clear"></div>
                    </div>
                
                    <div class="col-md-3 col-xs-3">
                        <div class="input-group" ng-show="!hasSubmitted">
                            <div class="input-group-addon" for="$"><i class="fa fa-usd"></i></div>
                            <input ng-value="items.sgd | currency: '' : 2" class="form-control" ng-keyup="calculateTotalSGD(commissions);" type="text" name="sgd[]" ng-model="items.sgd"/>
                        </div>
                        <span ng-show="hasSubmitted">@{{items.sgd!= null ? items.sgd : 0 | currency: '$' : 2}}</span>
                        <div class="clear"></div>
                    </div>

                    <div class="col-md-3 col-xs-3">
                        <div class="input-group" ng-show="!hasSubmitted">
                            <div class="input-group-addon" for="$"><i class="fa fa-jpy"></i></div>
                            <input ng-value="items.rmb | currency: '' : 2" class="form-control" ng-keyup="calculateTotalRMB(commissions);" type="text" name="rmb[]" ng-model="items.rmb"/>
                            <input class="form-control" type="hidden" name="id[]" ng-model="items.id"/>
                        </div>
                        <span ng-show="hasSubmitted">@{{items.rmb!= null ? items.rmb : 0 | currency: '' : 2}} RMB</span>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
                
            <div class="row" ng-show="!hasSubmitted">
                <button class="btn btn-info primary-btn" ng-click="addAttraction();">添加景点</button>
            </div>
                
            <div class="row marginTop50">
                <div class="form-group">
                    <label class="col-sm-2 col-xs-2 control-label">合计:</label>
                    
                    <div class="col-md-3 col-xs-5">
                        <div class="input-group" ng-show="!hasSubmitted">
                            <div class="input-group-addon" for="$"><i class="fa fa-usd"></i></div>
                            <input class="form-control" type="text" name="TotalSGD" ng-model="commissions.total_sgd"/>
                        </div>
                        <span ng-show="hasSubmitted">@{{commissions.total_sgd != null ? commissions.total_sgd : 0 | currency: '$' : 2}}</span>
                    </div>
                    <div class="col-md-3 col-xs-5">
                        <div class="input-group" ng-show="!hasSubmitted">
                            <div class="input-group-addon" for="$"><i class="fa fa-jpy"></i></div>
                            <input class="form-control" type="text" name="TotalRMB" ng-model="commissions.total_rmb"/>
                        </div>
                        <span ng-show="hasSubmitted">@{{commissions.total_rmb != null ? commissions.total_rmb : 0 | currency: '' : 2}} RMB</span>
                    </div>
                    
                </div>
            </div>
                
            <div class="row marginTop50">
                <div class="form-group">
                    <label class="col-sm-2 col-xs-2 control-label">&nbsp;</label>
                    
                    <div class="col-md-3 col-xs-5">
                        <input ng-show="!hasSubmitted" type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="commissions.sgd_to_company" />
                        <span ng-show="hasSubmitted">@{{commissions.sgd_to_company==1 ? "&#9745;" : "&#9744;"}}</span> 
                        新币对公司
                    </div>
                    <div class="col-md-3 col-xs-5">
                        <input ng-show="!hasSubmitted" type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="commissions.rmb_to_company" />
                        <span ng-show="hasSubmitted">@{{commissions.rmb_to_company==1 ? "&#9745;" : "&#9744;"}}</span> 
                        人民币对公司
                    </div>
                </div>
            </div>

            <div class="row marginTop50 signature">
                <div class="col-md-5 col-xs-5">
                    <div class="sigWrapper">
                        <ul class="sigNav">
                          <li class="clearButton"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="clear"></div>
                        <div class="sigPad kbw-signature @{{errors.tour_leader_signature ? 'error' : ''}}" id="TourLeaderSignature"></div>
                        <input type="hidden" class="output" id="tour_leader_signature" ng-model="commissions.tour_leader_signature" />
                    </div>
                    <label>领队签名</label>
                    <div class="clear"></div>
                    日期: @{{commissions.date}}
                </div>

                <div class="col-md-5 col-xs-5">
                    <div class="sigWrapper">
                        <ul class="sigNav">
                          <li class="clearButton"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="clear"></div>
                        <div class="sigPad kbw-signature @{{errors.tour_guide_signature ? 'error' : ''}}" id="TourGuideSignature"></div>
                        <input type="hidden" class="output" id="tour_guide_signature" ng-model="commissions.tour_guide_signature" />
                    </div>
                    <label>导游签名</label>
                    <div class="clear"></div>
                    日期: @{{commissions.date}}
                </div>
            </div>

            <div class="row buttons">
                <button ng-show="!hasSubmitted" class="btn btn-info primary-btn" ng-click="submitForm(commissions)">Submit</button>
            </div>

        </form>

    </div><!-- form -->
</div>