<h1>自费旅游项目协议书</h1>

<div ng-controller="OwnExpensesController">
    
    <a href="#!/fitbookings/forms/@{{ownExpenses.fitBookingId}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>
    
    <div class="form">
        <form name="form" class="form">
            
            <div class="row alert alert-danger" ng-show="errors">
                Please fix the following input errors:
                <ul>
                    <li ng-show="errors.representative">@{{errors.representative[0]}}</li>
                    <li ng-show="errors.signature">@{{errors.signature[0]}}</li>
                    <li ng-show="errors.tourLeaderSignature">@{{errors.tourLeaderSignature[0]}}</li>
                </ul>
            </div>
            
            <div class="row">
                <p>为丰富客人的娱乐活动，旅行社在不影响正常行程安排的前提下，提供自</p>
                <p>费景点项目供客人自行选择参加与否。因此在本次旅行过程，旅行社应客</p>
                <p>人要求并经双方协商一致，由旅行社协助安排客人参加自费旅游项目，约</p>
                <p>定如下：</p>
            </div>

            <div class="row">
                <ol>
                    <li>客人是自愿参加自费项目。</li>
                    <li>本协议约定下，由旅行社协助安排客人参加自费旅游项目的费用，将由导游负责代收款项。</li>
                    <li>签署本协议前，旅行社已将自费项目的安全风险注意事项告知客人，客人应根据身体条件谨慎选择，客人在本协议签字确认视为其已明确知悉相应安全风险注意事项，并自愿承受相应后果。</li>
                </ol>
            </div>

            <div class="row attractions">
                <div class="row" ng-repeat="attraction in ownExpenses.attractions">
                    <div class="col-md-1">景点:</div>
                    <div class="col-md-5"><input type="text" class="form-control" name="attraction[@{{$index}}]" ng-model="attraction.attraction"/></div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-info primary-btn" ng-click="addAttraction();">添加景点</button>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-9 col-md-9">
                    <div class="sigWrapper">
                        <ul class="sigNav">
                          <li class="clearButton"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="clear"></div>
                        <div class="sigPad kbw-signature @{{errors.signature ? 'error' : ''}}" id="Signature"></div>
                        <input type="hidden" class="output" id="signature" ng-model="ownExpenses.signature" />
                    </div>

                    <label>客人签名</label>

                </div>
                <div class="col-xs-2 col-md-2">
                    <div class="sigWrapper">
                        <ul class="sigNav">
                          <li class="clearButton"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="clear"></div>
                        <div class="sigPad kbw-signature @{{errors.tourLeaderSignature ? 'error' : ''}}" id="TourLeaderSignature"></div>
                        <input type="hidden" class="output" id="tour_leader_signature" ng-model="ownExpenses.tourLeaderSignature" />
                    </div>
                    <label>领队签名</label>
                </div>
            </div>

            <div class="row representative">
                <label>本人</label>
                    <input type="text" name="representative" class="@{{errors.representative ? 'error' : ''}} form-control short" placeholder="团员代表" ng-model="ownExpenses.representative"/>
                <label>代表以下团员代签。</label>
                <div class="clear"></div>
            </div>

            <div class="row customer-names">
                
                <div class="row" ng-repeat="name in ownExpenses.names">
                    <div class="col-md-1">团员名:</div>
                    <div class="col-md-5"><input type="text" class="form-control" name="name[@{{$index}}]" ng-model="name.name"/></div>
                </div>
                
                <div class="row">
                    <div class="col-md-5">
                        <button class="btn btn-info primary-btn" ng-click="addName();">添加客人</button>
                    </div>
                </div>
            </div>

            <div class="row buttons">
                <button class="btn btn-info primary-btn" ng-click="submitForm(ownExpenses);">Submit</button>
            </div>
        </form>

    </div><!-- form -->
</div>