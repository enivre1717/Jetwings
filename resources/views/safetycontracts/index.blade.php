<h1>离团安全责任书</h1>
<div ng-controller="SafetyContractController">
    <a href="#!/fitbookings/forms/@{{contract.fitBookingId}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>

    <div class="form">

        <form class="form">


        <?php //echo $form->errorSummary($model,NULL,NULL,array("class"=>"alert-danger alert")); ?>

        <div class="row">
            <h2>@{{bookingDetails.tour_code}} - 离团安全责任书</h2>
        </div>

        <div class="row">
            <p>旅游者充分了解并知晓以下情况：</p>
            <p>一、	@{{companyName}}及当地导游已多次劝阻不得脱团、离团；</p>
            <p>二、	脱团、离团期间自愿放弃原团队行程安排，认可旅游费用均已实际产生，不得要求退还；</p>
            <p>三、	脱团、离团期间产生的费用由本人承担；</p>
            <p>四、	脱团、离团期间遵守中国及所在国相关法律法规，并对自身的安全负责，在能够控制风险的范围内活动，不参加不适合自身条件或</p>
            <p>有安全危险的旅游活动，若因此导致人身损害、财产损失，旅游者应承担全部责任，不予采取任何方式向<?php //print($company_name); ?>及相关方追究责任；</p>
        </div>

        <div class="row">
            <p><label>本人</label>
                <label class="input">
                    <input class="form-control @{{errors.name ? 'error' : ''}}" name="name" type="text" ng-model="contract.name" />
                    <span class="alert alert-danger" ng-show="errors.name">@{{errors.name[0]}}</span>
                </label>
                <label>仍坚持于</label>
                <label class="short">
                    <input class="form-control" name="fromDateYr" type="text" ng-model="contract.fromDateYr"/>
                </label>
                <label>年</label>
                <label class="input select short">
                    <select class="form-control" name="fromDateMonth" ng-model="contract.fromDateMonth">
                        <option value="">- Select -</option>
                        <option value="@{{month.value}}" ng-repeat="month in monthList">@{{month.text}}</option>
                    </select>
                    <i></i>
                </label>
                <label>月</label>
                <label class="short">
                    <input class="form-control" name="fromDateDay" type="text" ng-model="contract.fromDateDay"/>
                </label>
                <label>日至</label>
                <label class="short">
                    <input class="form-control" name="ToDateYr" type="text" ng-model="contract.toDateYr" />
                </label>
                <label>年</label>
                <label class="input select short">
                    <select class="form-control" name="ToDateMonth" ng-model="contract.toDateMonth">
                        <option value="">- Select -</option>
                        <option value="@{{month.value}}" ng-repeat="month in monthList">@{{month.text}}</option>
                    </select>
                    <i></i>
                </label>
                <label>月</label>
                <label class="short">
                    <input class="form-control" name="ToDateDay" type="text" ng-model="contract.toDateDay" />
                </label>
                <label>日期间不参加团</label>
            </p>

            <div class="clear"></div>

            <p><label>队行程，脱团或离团自由活动，于</label>
                <label class="short">
                    <input class="form-control" name="JoinDateYr" type="text" ng-model="contract.joinDateYr"/>
                </label>
                <label>年</label>
                <label class="input select short">
                    <select class="form-control" name="JoinDateMonth" ng-model="contract.joinDateMonth">
                        <option value="">- Select -</option>
                        <option value="@{{month.value}}" ng-repeat="month in monthList">@{{month.text}}</option>
                    </select>
                    <i></i>
                </label>
                <label>月</label>
                <label class="short">
                    <input class="form-control" name="JoinDateDay" type="text" ng-model="contract.joinDateDay"/>
                </label>
                <label>日归团继续参加后续</label>
            </p>

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
                <div class="alert alert-danger" ng-show="errors.signature">@{{errors.signature[0]}}</div>
            </div>

            <label>签名</label>
            <label>（18岁以下需监护人同时签名）</label>

            <div class="row">
                <label>护照号码</label>
                <input class="form-control short @{{errors.nric ? 'error' : ''}}" name="Nric" type="text" ng-model="contract.nric"/>
                <div class="clear"></div>
                <div class="alert alert-danger" ng-show="errors.nric">@{{errors.nric[0]}}</div>
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