<div ng-controller="FormsController">
    <div class="loader" ng-show="!dataLoaded"></div>
    <div ng-show="dataLoaded">
        
        <a href="#!/fitbookings/list" class="btn btn-info primary-btn">Back</a>
        <div class="clear"></div>

        <div class="alert alert-@{{class}}" ng-show="msg != ''">
            @{{msg}}
        </div>

        <div class="content menu">

           <!-- Start Tour details-->
            <div class="row">
                <div class="col-md-2 col-sm-4">
                    <div class="hot-pink btn-lg"><span>
                        @{{bookingDetails.tour_code}}<br>团队详情</span></div>
                </div>

                <div class="col-md-10 col-sm-8">
                    <div class="row">
                        <a class="btn btn-block hot-pink" href="#!/fitbookings/details/@{{bookingDetails.id}}">团队资料</a></div>


                    <div class="row">
                        <a class="btn btn-block hot-pink" href="#!/fitbookings/welcome/@{{bookingDetails.id}}">接机牌</a>
                    </div>

                    <div class="row">
                        <a class="btn btn-block hot-pink" href="http://new.jetwings.asia/files/itinerary/@{{bookingDetails.itinerary_file}}" target="_blank" alt="Itinerary">行程</a>
                    </div>

                    <div class="row">
                        <a class="btn btn-block hot-pink" href="http://new.jetwings.asia/files/namelists/@{{bookingDetails.name_list_file}}" target="_blank" alt="Itinerary">名单</a>
                    </div>
                    
                    <div class="row">
                        <a ng-show="bookingDetails.ticket_file" class="btn btn-block hot-pink" href="http://new.jetwings.asia/files/tickets/@{{bookingDetails.ticket_file}}" target="_blank" alt="ferry_ticket">船票</a>
                        <div ng-hide="bookingDetails.ticket_file" class="btn btn-block hot-pink" alt="ferry_ticket">无船票</div>
                    </div>
                </div>
            </div>

           <!-- End Tour details-->
           

           <!-- Start Forms-->
            <div class="row">
                <div class="col-md-2 col-sm-4">
                    <div class="blue btn-lg"><span>表格</span></div>
                </div>

                <div class="col-md-10 col-sm-8">
                    <div class="row">
                        <a class="btn btn-block blue" href="#!/safety-contracts/index/@{{bookingDetails.id}}">离团安全责任书</a>
                    </div>

                    <div class="row">
                        <a class="btn btn-block blue" href="#!/own-expenses/index/@{{bookingDetails.id}}">自费旅游项目协议书</a>
                    </div>

                    <div class="row">
                        <a class="btn btn-block blue" href="#!/in-store/index/@{{bookingDetails.id}}">增加/减少景点协议书</a>
                    </div>

                    <div class="row">
                        <a class="btn btn-block blue" href="#!/feedback/index/@{{bookingDetails.id}}">意见表</a>
                    </div>

                </div>
            </div>
           <!-- End Forms-->

           <!-- Start 2nd Arrivals-->
            <div class="row">
                <div class="col-md-12">
                    <a ng-show="has2ndCall == 'true'" class="btn btn-block green" href="#!/arrival/index/@{{bookingDetails.id}}">二次交接与离新确认书</a>
                </div>
            </div>
            <!-- End 2nd Arrivals-->

            <!-- Start Funds-->
            <div class="row">
                <div class="col-md-2 col-sm-4">
                    <div class="orange btn-sm"><span>款项</span></div>
                </div>

                <div class="col-md-10 col-sm-8">
                    <div class="row">
                        <a class="btn btn-block orange" href="#!/commissions/index/@{{bookingDetails.id}}">佣金单</a>
                    </div>

                    <div class="row">
                        <a class="btn btn-block orange" href="#!/claims/index/@{{bookingDetails.id}}">请款单</a>
                    </div>
                </div>
            </div>
            <!-- End Funds-->
        </div>
    </div>
</div>