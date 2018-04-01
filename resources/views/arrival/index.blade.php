<div ng-controller="ArrivalFormController">
    
    <a href="#!/fitbookings/forms/@{{arrivalForms.fit_booking_id}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>
    
    <h1>二次交接与离新确认书</h1>
    <div class="form">
        <form name="form" class="j-forms arrival-form" novalidate>
    
            <div class="row">
                <div class="col-md-5">
                    <div class="col-md-5">团号：</div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="tourCode" ng-model="arrivalForms.tour_code" ng-show="!hasSubmitted"/>
                        <span ng-show="hasSubmitted">@{{arrivalForms.tour_code}}</span>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="col-md-5">二次交接关口：</div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="twoNdArrival" ng-model="arrivalForms.two_nd_arrival" ng-show="!hasSubmitted"/>
                        <span ng-show="hasSubmitted">@{{arrivalForms.two_nd_arrival}}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="col-md-5">二次入新日期：</div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="departureDate" ng-model="arrivalForms.departure_date" ng-show="!hasSubmitted"/>
                        <span ng-show="hasSubmitted">@{{arrivalForms.departure_date}}</span>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="col-md-5">二次交接时间：</div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="arrivalTime" ng-model="arrivalForms.arrival_time" ng-show="!hasSubmitted"/>
                        <span ng-show="hasSubmitted">@{{arrivalForms.arrival_time}}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 arrival-flight">
                    <div class="col-md-5">二次离新航班：</div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="departureFlight" ng-model="arrivalForms.departure_flight" ng-show="!hasSubmitted"/>
                        <span ng-show="hasSubmitted">@{{arrivalForms.departure_flight}}</span>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="departureTime" ng-model="arrivalForms.departure_time" ng-show="!hasSubmitted"/>
                        <span ng-show="hasSubmitted">@{{arrivalForms.departure_time}}</span>
                    </div>
                </div>
            </div>

            <div class="row align-center">
                    *如有任何更动，务必通知负责人，陈先生 81865254*
            </div>

            <div class="row marginTop50">
                <div class="col-xs-5 col-md-5">
                    <div class="sigWrapper">
                        <ul class="sigNav">
                          <li class="clearButton"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="clear"></div>
                        <div class="sigPad <?php //print($arrivalModel->getError("tour_guide_signature") ? "error" : ""); ?>" id="TourGuideSignature"></div>
                        <?php //echo $form->hiddenField($arrivalModel,'tour_guide_signature',array("class"=>"output")); ?>
                    </div>
                    <label>导游确认</label>
                </div>

                <div class="col-xs-5 col-md-5">
                    <div class="sigWrapper">
                        <ul class="sigNav">
                          <li class="clearButton"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="clear"></div>
                        <div class="sigPad <?php //print($arrivalModel->getError("tour_leader_signature") ? "error" : ""); ?>" id="TourLeaderSignature"></div>
                        <?php //echo $form->hiddenField($arrivalModel,'tour_leader_signature',array("class"=>"output")); ?>
                    </div>
                    <label>领队确认</label>
                </div>
            </div>

            <div class="row align-center">
                <strong>*请领队拍下此确认为证。</strong>
            </div>

            <div class="clear"></div>
            
            <div class="row buttons" ng-show="!hasSubmitted">
                <button class="btn btn-info primary-btn" ng-click="submitForm(arrivalForms);">Submit</button>
            </div>
            

            <div class="row"></div>



        </form>

    </div><!-- form -->
</div>