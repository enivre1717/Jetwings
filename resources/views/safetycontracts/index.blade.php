<h1>离团安全责任书</h1>
<div ng-controller="SafetyContractController">
    <a href="#!/fitbookings/forms/@{{contract.fitBookingId}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>

    <div class="form">

        <form class="form safety-form">


        <div class="row alert alert-danger" ng-show="errors">
            Please fix the following input errors:
            <ul>
                <li ng-show="errors.name">@{{errors.name[0]}}</li>
                <li ng-show="errors.fromDateYr">@{{errors.fromDateYr[0]}}</li>
                <li ng-show="errors.fromDateDay">@{{errors.fromDateDay[0]}}</li>
                <li ng-show="errors.toDateYr">@{{errors.toDateYr[0]}}</li>
                <li ng-show="errors.toDateDay">@{{errors.toDateDay[0]}}</li>
                <li ng-show="errors.joinDateYr">@{{errors.joinDateYr[0]}}</li>
                <li ng-show="errors.joinDateDay">@{{errors.joinDateDay[0]}}</li>
                <li ng-show="errors.signature">@{{errors.signature[0]}}</li>
                <li ng-show="errors.nric">@{{errors.nric[0]}}</li>
            </ul>
        </div>

        <div class="row">
            <h2>@{{bookingDetails.tour_code}} - 离团安全责任书</h2>
        </div>

        <div class="row">
            <p>旅游者充分了解并知晓以下情况：</p>
            <p>一、	@{{companyName}}及当地导游已多次劝阻不得脱团、离团；</p>
            <p>二、	脱团、离团期间自愿放弃原团队行程安排，认可旅游费用均已实际产生，不得要求退还；</p>
            <p>三、	脱团、离团期间产生的费用由本人承担；</p>
            <p>四、	脱团、离团期间遵守中国及所在国相关法律法规，并对自身的安全负责，在能够控制风险的范围内活动，不参加不适合自身条件或</p>
            <p>有安全危险的旅游活动，若因此导致人身损害、财产损失，旅游者应承担全部责任，不予采取任何方式向@{{companyName}}及相关方追究责任；</p>
        </div>

        <div class="row">
            <span>本人</span>
                <label class="short">
                    <input class="form-control @{{errors.name ? 'error' : ''}}" name="name" type="text" ng-model="contract.name" />
                </label>
                <span>仍坚持于</span>
                <label class="short">
                    <input class="form-control @{{errors.fromDateYr ? 'error' : ''}}" name="fromDateYr" type="text" ng-model="contract.fromDateYr"/>
                </label>
                <span>年</span>
                <label class="input select short">
                    <select class="form-control" name="fromDateMonth" ng-model="contract.fromDateMonth">
                        <option value="">- Select -</option>
                        <option value="@{{month.value}}" ng-repeat="month in monthList">@{{month.text}}</option>
                    </select>
                    <i></i>
                </label>
                <span>月</span>
                <label class="short">
                    <input class="form-control @{{errors.fromDateDay ? 'error' : ''}}" name="fromDateDay" type="text" ng-model="contract.fromDateDay"/>
                </label>
                <span>日至</span>
                <label class="short">
                    <input class="form-control @{{errors.toDateYr ? 'error' : ''}}" name="ToDateYr" type="text" ng-model="contract.toDateYr" />
                </label>
                <span>年</span>
                <label class="input select short">
                    <select class="form-control" name="ToDateMonth" ng-model="contract.toDateMonth">
                        <option value="">- Select -</option>
                        <option value="@{{month.value}}" ng-repeat="month in monthList">@{{month.text}}</option>
                    </select>
                    <i></i>
                </label>
                <span>月</span>
                <label class="short">
                    <input class="form-control @{{errors.toDateDay ? 'error' : ''}}" name="ToDateDay" type="text" ng-model="contract.toDateDay" />
                </label>
                <span>日期间不参加团</span>
            

            <div class="clear"></div>

            <span>队行程，脱团或离团自由活动，于</span>
                <label class="short">
                    <input class="form-control @{{errors.joinDateYr ? 'error' : ''}}" name="JoinDateYr" type="text" ng-model="contract.joinDateYr"/>
                </label>
                <span>年</span>
                <label class="input select short">
                    <select class="form-control" name="JoinDateMonth" ng-model="contract.joinDateMonth">
                        <option value="">- Select -</option>
                        <option value="@{{month.value}}" ng-repeat="month in monthList">@{{month.text}}</option>
                    </select>
                    <i></i>
                </label>
                <span>月</span>
                <label class="short">
                    <input class="form-control @{{errors.joinDateDay ? 'error' : ''}}" name="JoinDateDay" type="text" ng-model="contract.joinDateDay"/>
                </label>
                <span>日归团继续参加后续</span>
            

            <div class="clear"></div>

            <p>行程,如因未及时归团、滞留当地、违法行为等给@{{companyName}}带来的一</p>
            <p>切损失均全权承担。</p>
        </div>


        <div class="row">
            <div class="sigWrapper">
                <ul class="sigNav">
                  <li class="clearButton"><a href="#clear">Clear</a></li>
                </ul>
                <div class="clear"></div>
                <div class="sigPad kbw-signature @{{errors.signature ? 'error' : ''}}" id="Signature"></div>
                <input type="hidden" class="output" id="contract_signature" ng-model="contract.signature" />
            </div>

            <label>签名</label>
            <label>（18岁以下需监护人同时签名）</label>

            <div class="row">
                <label>护照号码</label>
                <input class="form-control short @{{errors.nric ? 'error' : ''}}" name="Nric" type="text" ng-model="contract.nric"/>
            </div>

            <div class="row">
                日期：@{{todayDate}}
            </div>
        </div>

        <div class="row buttons">
            <input class="btn btn-info primary-btn" type="button" ng-click="submitContract(contract);" value="Submit">
        </div>

        </form>

    </div><!-- form -->
</div>