<h1>增加/减少景点协议书</h1>

<div ng-controller="InStoreController">
    <a href="#!/fitbookings/forms/@{{inStore.fitBookingId}}" class="btn primary-btn orange">Back</a>
    <div class="clear"></div>

    <div class="form">
        <form name="form" class="j-forms">
            
            <div class="row alert alert-danger" ng-show="errors">
                Please fix the following input errors:
                <ul>
                    <li ng-show="errors.addRemoveAttraction">@{{errors.addRemoveAttraction[0]}}</li>
                    <li ng-show="errors.representative">@{{errors.representative[0]}}</li>
                    <li ng-show="errors.signature">@{{errors.signature[0]}}</li>
                    <li ng-show="errors.tourLeaderSignature">@{{errors.tourLeaderSignature[0]}}</li>
                </ul>
            </div>
            
            <div class="row">
                <p>为丰富旅游者的娱乐活动及购物需求，旅行社在不影响正常行程安排的前提下，</p>
                <p>
                    <label class="radio">
                        建议增加景点。
                        <input class="@{{errors.addRemoveAttraction ? 'error' : ''}}" value="Add" ng-model="inStore.addRemoveAttraction" name="add_remove_attraction" type="radio"><i></i>
                    </label>
                </p>
                <p>
                <label class="radio">
                    客人要求减少景点。
                    <input class="@{{errors.addRemoveAttraction ? 'error' : ''}}" value="Remove" ng-model="inStore.addRemoveAttraction" name="add_remove_attraction" type="radio"><i></i>
                </label>
                </p>
            </div>

            <div class="row attractions">
                <div class="row" ng-repeat="attraction in inStore.attractions">
                    <div class="col-md-10 col-xs-12">
                        <!-- <label>景点:</label> -->
                        <input type="text" placeholder="景点" maxlength="255" class="form-control" name="attraction[@{{$index}}]" ng-model="attraction.attraction"/>
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn primary-btn orange pull-right" ng-click="addAttraction();">添加景点</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <p>因此在本次旅行过程，旅行社</p>
                <p>应客人要求并经双方协商一致，由旅行社协助安排此次行程。</p>
            </div>

            <div class="row">
                <div class="col-xs-9 col-md-9 no-padding-left">
                    <div class="sigWrapper">
                        <ul class="sigNav">
                            <li class="clearButton"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="clear"></div>
                        <div class="sigPad kbw-signature @{{errors.signature ? 'error' : ''}}" id="Signature"></div>
                        <input class="output" name="signature" id="InStoreForms_signature" type="hidden" ng-value="inStore.signature">
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
                        <div class="sigPad kbw-signature @{{errors.tourLeaderSignature ? 'error' : ''}}" id="TourLeaderSignature"></div>
                        <input class="output" name="tour_leader_signature" id="InStoreForms_tour_leader_signature" type="hidden" ng-value="inStore.tourLeaderSignature">
                        <div class="clear"></div>
                    </div>
                    <label>领队签名</label>
                </div>
            </div>

            <div class="row representative">
                <label>本人</label>
                <input class="form-control short @{{errors.representative ? 'error' : ''}}" placeholder="团员代表" name="representative" id="InStoreForms_representative" maxlength="255" type="text" ng-model="inStore.representative">
                <label>代表以下团员代签。</label>
                <div class="clear"></div>
            </div>

            <div class="row customer-names">
                <div class="row names" ng-repeat="name in inStore.names">
                    <div class="col-md-1">
                        <label>团员名:</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" placeholder="名" maxlength="255" class="form-control" name="name[@{{$index}}]" ng-model="name.name"/>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-5">
                        <button class="btn primary-btn orange" ng-click="addName();">添加客人</button>
                    </div>
                </div>
            </div>
            
            <div class="row buttons">
                <button class="btn primary-btn orange" ng-click="submitForm(inStore);">Submit</button>
            </div>
        </form>
    </div>
</div>