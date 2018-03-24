<h1>自费旅游项目协议书</h1>

<div ng-controller="OwnExpensesController">
    
    <a href="#!/fitbookings/forms/@{{ownExpenses.fitBookingId}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>
    
    <div class="form">
        <form name="form" class="j-forms form">
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
                    <div class="col-md-5">
                        <label>景点:</label>
                        <input type="text" class="form-control" name="attraction[@{{$index}}]" ng-model="attraction.attraction"/>
                        <div class="clear"></div>
                        
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-5">
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
                        <div class="sigPad <?php //print($model->getError("signature") ? "error" : ""); ?>" id="Signature"></div>
                        <?php //echo $form->hiddenField($model,'signature',array("class"=>"output")); ?>
                        <div class="clear"></div>
                        <?php //echo $form->error($model, 'signature',array("class"=>"marginLeft20 errorMessage")); ?>
                    </div>

                    <label>客人签名</label>

                </div>
                <div class="col-xs-2 col-md-2">
                    <div class="sigWrapper">
                        <ul class="sigNav">
                          <li class="clearButton"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="clear"></div>
                        <div class="sigPad <?php //print($model->getError("tour_leader_signature")!="" ? "error" : ""); ?>" id="TourLeaderSignature"></div>
                        <?php //echo $form->hiddenField($model,'tour_leader_signature',array("class"=>"output")); ?>
                        <div class="clear"></div>
                        <?php //echo $form->error($model, 'tour_leader_signature',array("class"=>"marginLeft20 errorMessage")); ?>
                    </div>
                    <label>领队签名</label>
                </div>
            </div>

            <div class="row representative">
                <label>本人</label>
                    <input type="text" name="representative" class="form-control" placeholder="团员代表" ng-model="ownExpenses.representative"/>
                <label>代表以下团员代签。</label>
                <div class="clear"></div>
            </div>

            <div class="row customer-names">
                <?php
                    //$r=0;
                    //foreach($aryCustomerNames as $ownExpensesFormNameModel){ 
                ?>
                <div class="row" ng-repeat="name in ownExpenses.names">
                    <div class="col-md-5">
                        <label>团员名:</label>
                        <input type="text" class="form-control" name="name[@{{$index}}]" ng-model="name.name"/>
                        <div class="clear"></div>
                    </div>
                </div>
                <?php 
                        //$r++;
                    //}//for 
                ?>

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