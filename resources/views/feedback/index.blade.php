<h1>意见表</h1>

<div ng-controller="FeedbackController">
    FEEDBACK
    <div class="form">
        <form id="feedback-form" name="form" class="j-forms form" style="margin-top:4% !important;">
            <div class="row">
                <div class="col-md-5">
                    团号 Tour Code:
                    @{{fitBookings.tour_code}}
                </div>

                <div class="col-md-5">
                    Name: @{{saleAgencies.name}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    领队 Tour Leader:
                    @{{fitBookings.tour_leader}}]
                </div>

                <div class="col-md-5">
                    导游 Tour Guide:
                    @{{fitBookings.tour_guide_ids}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    车牌 Coach No.:
                    @{{fitBookings.agency}}
                </div>
            </div>

            <!-- Tour Guide Feedback -->
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="col-md-4">
                                导游 TOUR GUIDE<span class="pull-right">全选</span>
                            </div>
                            <div class="col-xs-2 col-md-1" ng-repeat="mainotp in ratings">
                                <label class="radio">
                                    <input name="tourguide" value="@{{mainotp.value}}" ng-click="handleRadioClick('tourguide',mainotp)" ng-value="$index" ng-model="selected.en_value" type="radio" />
                                    <i></i>
                                </label>
                            </div>
                        </h3>
                    </div>
                    <div class="clear"></div>
                    <div class="panel-body tourguide">
                        <div class="row">
                            <div class="col-md-4 col-xs-4"></div>
                            <div class="col-xs-2 col-md-1" ng-repeat="labelotp in ratings">
                                @{{labelotp.value}}
                            </div>
                        </div>
                        <div class="row" ng-repeat="fb in feedbackTourguideOptions">
                            <div class="col-md-4 col-xs-4">
                                @{{fb.label}}
                            </div>
                            <div class="col-xs-2 col-md-1" ng-repeat="childotp in ratings">
                                <label class="radio">
                                    <input name="@{{fb.name}}" value="@{{childotp.value}}" type="radio" class="@{{fb.class+'-'+childotp.en_value}}" />
                                    <i></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coach Feedback -->
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="col-md-4">
                                游览车 COACH <span>全选</span>
                            </div>
                            <div class="col-xs-2 col-md-1" ng-repeat="mainotp in ratings">
                                <label class="radio">
                                    <input name="coach[]" value="@{{mainotp.value}}" ng-click="handleRadioClick('coach',mainotp)" ng-value="$index" ng-model="selected.en_value" type="radio" />
                                    <i></i>
                                </label>
                            </div>
                        </h3>
                    </div>
                    <div class="clear"></div>
                    <div class="panel-body coach">
                        <div class="row">
                            <div class="col-md-4 col-xs-4"></div>
                            <div class="col-xs-2 col-md-1" ng-repeat="labelotp in ratings">
                                @{{labelotp.value}}
                            </div>
                        </div>
                        <div class="row" ng-repeat="fb in feedbackCoachOptions">
                            <div class="col-md-4 col-xs-4">
                                @{{fb.label}}
                            </div>
                            <div class="col-xs-2 col-md-1" ng-repeat="childotp in ratings">
                                <label class="radio">
                                    <input name="@{{fb.name}}" value="@{{childotp.value}}" type="radio" class="@{{fb.class+'-'+childotp.en_value}}" />
                                    <i></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hotel Feedback -->
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="col-md-4">
                                酒店 HOTEL<span>全选</span>
                            </div>
                            <div class="col-xs-2 col-md-1" ng-repeat="mainotp in ratings">
                                <label class="radio">
                                    <input name="hotel[]" value="@{{mainotp.value}}" ng-click="handleRadioClick('hotel',mainotp)" ng-value="$index" ng-model="selected.en_value" type="radio" />
                                    <i></i>
                                </label>
                            </div>
                        </h3>
                    </div>
                    <div class="clear"></div>
                    <div class="panel-body hotel">
                        <div class="row">
                            <div class="col-md-4 col-xs-4"></div>
                            <div class="col-xs-2 col-md-1" ng-repeat="labelotp in ratings">
                                @{{labelotp.value}}
                            </div>
                        </div>
                        <div class="row" ng-repeat="fb in feedbackHotelOptions">
                            <div class="col-md-4 col-xs-4">
                                @{{fb.label}}
                            </div>
                            <div class="col-xs-2 col-md-1" ng-repeat="childotp in ratings">
                                <label class="radio">
                                    <input name="@{{fb.name}}" value="@{{childotp.value}}" type="radio" class="@{{fb.class+'-'+childotp.en_value}}" />
                                    <i></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Restaurant Feedback -->
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="col-md-4">
                                餐厅 RESTAURANT<span>全选</span>
                            </div>
                            <div class="col-xs-2 col-md-1" ng-repeat="mainotp in ratings">
                                <label class="radio">
                                    <input name="restaurant[]" value="@{{mainotp.value}}" ng-click="handleRadioClick('restaurant',mainotp)" ng-value="$index" ng-model="selected.en_value" type="radio" />
                                    <i></i>
                                </label>
                            </div>
                        </h3>
                    </div>
                    <div class="clear"></div>
                    <div class="panel-body restautants">
                        <div class="row">
                            <div class="col-md-4 col-xs-4"></div>
                            <div class="col-xs-2 col-md-1" ng-repeat="labelotp in ratings">
                                @{{labelotp.value}}
                            </div>
                        </div>
                        <div class="row" ng-repeat="restaurant in feedback.restaurants">
                            <div class="col-md-4 col-xs-4">
                                <label class="input select">
                                    <select class="form-control" name="restaurant[@{{$index}}]" ng-model="restaurant.restaurant_id">
                                        <option value="">- Select -</option>
                                        <option value="@{{item.id}}" ng-repeat="item in restaurantlist">@{{item.name}}</option>
                                    </select>
                                    <i></i>
                                    <div class="clear"></div>
                                </label>
                            </div>
                            <div class="col-xs-2 col-md-1" ng-repeat="childotp in ratings">
                                <label class="radio">
                                    <input name="restaurant_rate[@{{$parent.$index}}]" value="@{{childotp.value}}" type="radio" class="@{{'fb-restaurant-'+childotp.en_value}}" ng-model="restaurant.rating" />
                                    <i></i>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <button class="btn btn-info primary-btn pull-right" ng-click="addRestaurantFeedback();">添加客人</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Feeback forms -->
            <div class="row">
                <label for="Feedbacks_remarks">其他意见</label>
                <textarea class="form-control" name="Feedbacks[remarks]" id="Feedbacks_remarks" ng-model="feedback.remarks"></textarea>
            </div>

            <div class="row">
                <div class="panel">
                    <div class="col-xs-9 col-md-9 no-padding-left">
                        <div class="sigWrapper">
                            <ul class="sigNav">
                                <li class="clearButton"><a href="#clear">Clear</a></li>
                            </ul>
                            <div class="clear"></div>
                            <div class="sigPad kbw-signature" id="Signature"></div>
                            <input class="output" name="signature" id="feedback_signature" type="hidden" ng-value="feedback.signature">
                            <div class="clear"></div>
                        </div>
                        <label>客人签名</label>
                    </div>
                    
                    <div class="col-xs-3 col-md-3 no-padding-right">
                        <div class="sigWrapper">
                            <ul class="sigNav">
                                <li class="clearButton"><a href="#clear">Clear</a></li>
                            </ul>
                            <div class="clear"></div>
                            <div class="sigPad kbw-signature" id="TourLeaderSignature"></div>
                            <input class="output" name="tour_leader_signature" id="feedback_tour_leader_signature" type="hidden" ng-value="feedback.tourLeaderSignature">
                            <div class="clear"></div>
                        </div>
                        <label>领队签名</label>
                    </div>
                </div>
                
            </div>
            <div class="row marginTop50">
                <div class="clear"></div>
                <label>本人</label>
                <input class="form-control short" placeholder="团员代表" name="representative" id="Feedbacks_representative" maxlength="255" type="text" ng-model="feedback.representative" />
                <label>代表以下团员代签。</label>
            </div>

            <div class="row">
                <div class="row" ng-repeat="name in feedback.names">
                    <div class="col-md-5">
                        <label>团员名:</label>
                        <input type="text" placeholder="景点" maxlength="255" class="form-control" name="name[@{{$index}}]" ng-model="name.name"/>
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-5">
                        <button class="btn btn-info primary-btn" ng-click="addName();">添加客人</button>
                    </div>
                </div>
            </div>

            <div class="row buttons">
                <button class="btn btn-info primary-btn" ng-click="submitForm(feedback);">Submit</button>
            </div>
        </form>
    </div>
</div>

