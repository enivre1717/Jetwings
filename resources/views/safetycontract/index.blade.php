<h1>离团安全责任书</h1>
<div ng-controller="SafetyContractController">
    <div class="form">

        <form class="form">


        <?php //echo $form->errorSummary($model,NULL,NULL,array("class"=>"alert-danger alert")); ?>

        <div class="row">
            <h2><?php //print($fitModel["tour_code"]); ?> - 离团安全责任书</h2>
        </div>

        <div class="row">
            <p>旅游者充分了解并知晓以下情况：</p>
            <?php
                //$company_name=SaleAgencies::model()->getCompanyNameById($fitModel->sale_agency_id);
            ?>
            <p>一、	<?php //print($company_name); ?>及当地导游已多次劝阻不得脱团、离团；</p>
            <p>二、	脱团、离团期间自愿放弃原团队行程安排，认可旅游费用均已实际产生，不得要求退还；</p>
            <p>三、	脱团、离团期间产生的费用由本人承担；</p>
            <p>四、	脱团、离团期间遵守中国及所在国相关法律法规，并对自身的安全负责，在能够控制风险的范围内活动，不参加不适合自身条件或</p>
            <p>有安全危险的旅游活动，若因此导致人身损害、财产损失，旅游者应承担全部责任，不予采取任何方式向<?php //print($company_name); ?>及相关方追究责任；</p>
        </div>

        <div class="row">
            <p><label>本人</label>
                <label class="input">
                    <input class="form-control <?php //print($model->hasErrors("name") ? "error" : ""); ?>" name="SafetyAffirmationResponsibilityContracts[name]" id="SafetyAffirmationResponsibilityContracts_Name" type="text" 
                           value="<?php //print(isset($_POST["SafetyAffirmationResponsibilityContracts"]["name"]) ? $_POST["SafetyAffirmationResponsibilityContracts"]["name"] : ""); ?>">
                </label>
                <label>仍坚持于</label>
                <label class="short">
                    <input class="form-control <?php //print($model->hasErrors("from_date") ? "error" : ""); ?>" name="SafetyAffirmationResponsibilityContracts[FromDateYr]" id="SafetyAffirmationResponsibilityContracts_FromDateYr" type="text" 
                           value="<?php //print(isset($_POST["SafetyAffirmationResponsibilityContracts"]["FromDateYr"]) ? $_POST["SafetyAffirmationResponsibilityContracts"]["FromDateYr"] : date("Y")); ?>">
                </label>
                <label>年</label>
                <label class="input select short">
                    <select class="form-control <?php //print($model->hasErrors("from_date") ? "error" : ""); ?>" name="SafetyAffirmationResponsibilityContracts[FromDateMonth]" id="SafetyAffirmationResponsibilityContracts_FromDateMonth">
                        <?php //for ($m = 1; $m <= 12; $m++) { ?>
                            <option value="<?php //print($m); ?>" <?php //print($m == (isset($_POST["SafetyAffirmationResponsibilityContracts"]["FromDateMonth"]) ? $_POST["SafetyAffirmationResponsibilityContracts"]["FromDateMonth"] : date("m")) ? "selected" : ""); ?>><?php //print($m); ?></option>
                        <?php //}//for  ?>
                    </select>
                    <i></i>
                </label>
                <label>月</label>
                <label class="short">
                    <input class="form-control <?php //print($model->hasErrors("from_date") ? "error" : ""); ?>" name="SafetyAffirmationResponsibilityContracts[FromDateDay]" id="SafetyAffirmationResponsibilityContracts_FromDateDay" type="text" 
                           value="<?php //print(isset($_POST["SafetyAffirmationResponsibilityContracts"]["FromDateDay"]) ? $_POST["SafetyAffirmationResponsibilityContracts"]["FromDateDay"] : date("d")); ?>">
                </label>
                <label>日至</label>
                <label class="short">
                    <input class="form-control <?php //print($model->hasErrors("to_date") ? "error" : ""); ?>" name="SafetyAffirmationResponsibilityContracts[ToDateYr]" id="SafetyAffirmationResponsibilityContracts_ToDateYr" type="text" 
                     value="<?php //print(isset($_POST["SafetyAffirmationResponsibilityContracts"]["ToDateYr"]) ? $_POST["SafetyAffirmationResponsibilityContracts"]["ToDateYr"] : date("Y")); ?>">
                </label>
                <label>年</label>
                <label class="input select short">
                    <select class="form-control <?php //print($model->hasErrors("to_date") ? "error" : ""); ?>" name="SafetyAffirmationResponsibilityContracts[ToDateMonth]" id="SafetyAffirmationResponsibilityContracts_ToDateMonth">
                        <?php //for ($m = 1; $m <= 12; $m++) { ?>
                            <option value="<?php //print($m); ?>" <?php //print($m == (isset($_POST["SafetyAffirmationResponsibilityContracts"]["ToDateMonth"]) ? $_POST["SafetyAffirmationResponsibilityContracts"]["ToDateMonth"] : date("m")) ? "selected" : ""); ?>><?php //print($m); ?></option>
                        <?php //}//for  ?>
                    </select>
                    <i></i>
                </label>
                <label>月</label>
                <label class="short">
                    <input class="form-control <?php //print($model->hasErrors("to_date") ? "error" : ""); ?>" name="SafetyAffirmationResponsibilityContracts[ToDateDay]" id="SafetyAffirmationResponsibilityContracts_ToDateDay" type="text" 
                    value="<?php //print(isset($_POST["SafetyAffirmationResponsibilityContracts"]["ToDateDay"]) ? $_POST["SafetyAffirmationResponsibilityContracts"]["ToDateDay"] : ""); ?>">
                </label>
                <label>日期间不参加团</label>
            </p>

            <div class="clear"></div>

            <p><label>队行程，脱团或离团自由活动，于</label>
                <label class="short">
                    <input class="form-control <?php //print($model->hasErrors("join_date") ? "error" : ""); ?>" name="SafetyAffirmationResponsibilityContracts[JoinDateYr]" id="SafetyAffirmationResponsibilityContracts_JoinDateYr" type="text" 
                    value="<?php //print(isset($_POST["SafetyAffirmationResponsibilityContracts"]["JoinDateYr"]) ? $_POST["SafetyAffirmationResponsibilityContracts"]["JoinDateYr"] : date("Y")); ?>">
                </label>
                <label>年</label>
                <label class="input select short">
                    <select class="form-control <?php //print($model->hasErrors("join_date") ? "error" : ""); ?>" name="SafetyAffirmationResponsibilityContracts[JoinDateMonth]" id="SafetyAffirmationResponsibilityContracts_JoinDateMonth">
                        <?php //for ($m = 1; $m <= 12; $m++) { ?>
                            <option value="<?php //print($m); ?>" <?php //print($m == (isset($_POST["SafetyAffirmationResponsibilityContracts"]["JoinDateMonth"]) ? $_POST["SafetyAffirmationResponsibilityContracts"]["JoinDateMonth"] : date("m")) ? "selected" : ""); ?>><?php //print($m); ?></option>
                        <?php //}//for  ?>
                    </select>
                    <i></i>
                </label>
                <label>月</label>
                <label class="short">
                    <input class="form-control <?php //print($model->hasErrors("join_date") ? "error" : ""); ?>" name="SafetyAffirmationResponsibilityContracts[JoinDateDay]" id="SafetyAffirmationResponsibilityContracts_JoinDateDay" type="text" 
                    value="<?php //print(isset($_POST["SafetyAffirmationResponsibilityContracts"]["JoinDateDay"]) ? $_POST["SafetyAffirmationResponsibilityContracts"]["JoinDateDay"] : ""); ?>">
                </label>
                <label>日归团继续参加后续</label>
            </p>

            <div class="clear"></div>

            <p>行程,如因未及时归团、滞留当地、违法行为等给<?php //print($company_name); ?>带来的一</p>
            <p>切损失均全权承担。</p>
        </div>


        <div class="row">
            <div class="col-xs-5 col-md-5"></div>
            <div class="col-xs-5 col-md-5">
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

                <label>签名</label>
                <label>（18岁以下需监护人同时签名）</label>

                <div class="row">
                    <?php //echo $form->labelEx($model, 'nric', array('class' => "short-xs")); ?>
                    <?php //echo $form->textField($model, 'nric', array('class' => "form-control short")); ?>
                    <div class="clear"></div>
                    <?php //echo $form->error($model, 'nric',array("class"=>"marginLeft20 errorMessage")); ?>
                </div>

                <div class="row">
                    日期：<?php //print(date("d/m/Y")); ?>
                </div>
            </div>
        </div>

        <div class="row buttons">
            <?php //echo CHtml::submitButton("Submit",array("class"=>"btn btn-info primary-btn")); ?>
        </div>

        <div class="row">
            <?php //echo $form->hiddenField($model, 'created_at',array("value"=>date("Y-m-d H:i:s"))); ?>
            <?php //echo $form->error($model, 'AddedOn'); ?>
        </div>

        <div class="row">
            <?php //echo $form->hiddenField($model, 'created_by',array("value"=>Yii::app()->user->id)); ?>
            <?php //echo $form->error($model, 'AddedByID'); ?>
        </div>

        <div class="row">
            <?php //echo $form->hiddenField($model, 'updated_at',array("value"=>date("Y-m-d H:i:s"))); ?>
            <?php //echo $form->error($model, 'UpdatedOn'); ?>
        </div>

        <div class="row">
            <?php //echo $form->hiddenField($model, 'updated_by',array("value"=>Yii::app()->user->id)); ?>
            <?php //echo $form->error($model, 'UpdatedByID'); ?>
        </div>

        <div class="row">
            <?php //echo $form->hiddenField($model, 'fit_booking_id'); ?>
            <?php //echo $form->error($model, 'FITBookingID'); ?>
        </div>

        </form>

    </div><!-- form -->
</div>