<div ng-controller="FormsController">
    <div class="content menu">
        <div class="col-md-1">
            <div class="hot-pink btn-lg"><span>
                @{{bookingDetails.tour_code}}<br>团队详情</span></div>
        </div>

        <div class="col-md-10">
            <a class="btn btn-small hot-pink" href="#!/fitbookings/details/@{{bookingDetails.id}}">团队资料</a>
            <div class="clear"></div>
            
            <a class="btn btn-small hot-pink" href="#!/fitbookings/welcome/@{{bookingDetails.id}}">接机牌</a>
            
            <div class="clear"></div>
            
            <?php //$itineraryFile=FitBookings::model()->getItineraryFileByBookingID($id); 
              //print(CHtml::link("行程",$itineraryFile!="" ? "http://new.jetwings.asia/files/itinerary/".$itineraryFile : "#",array("class"=>"btn btn-small hot-pink","target"=>"_blank"))); 
            ?>
            <div class="clear"></div>
            <?php //$nameListFile=FitBookings::model()->getNameListFileByBookingID($id); 
              //print(CHtml::link("名单",$nameListFile!="" ? array("fitBooking/nameList","id"=>$id) : "#",array("class"=>"btn btn-small hot-pink","target"=>"_blank"))); 
                //print(CHtml::link("名单",$nameListFile!="" ? "http://new.jetwings.asia/files/namelists/".$nameListFile : "#",array("class"=>"btn btn-small hot-pink","target"=>"_blank"))); 
            ?>
        </div>

        <div class="clear"></div>

        <div class="col-md-1">
            <div class="blue btn-lg"><span>表格</span></div>
        </div>

        <div class="col-md-10">
            <a class="btn btn-small blue" href="#!/safety-contract/index/@{{bookingDetails.id}}">离团安全责任书</a>
            
            <div class="clear"></div>
            
            <a class="btn btn-small blue" href="#!/own-expenses/index/@{{bookingDetails.id}}">自费旅游项目协议书</a>
            
            <div class="clear"></div>
            
            <a class="btn btn-small blue" href="#!/in-store/index/@{{bookingDetails.id}}">增加/减少景点协议书</a>
            
            <div class="clear"></div>
            
            <a class="btn btn-small blue" href="#!/feedback/index/@{{bookingDetails.id}}">意见表</a>
            
            <div class="clear"></div>

        </div>

        <div class="clear"></div>

        <?php
            //if(FitBookings::model()->checkHave2ndArrival($id)){
        ?>
        <a class="btn btn-info btn-xlg green" href="#!/arrival/index/@{{bookingDetails.id}}">二次交接与离新确认书</a>
        
        <?php //}//if have 2nd arrival ?>

        <div class="clear"></div>

        <div class="col-md-1">
            <div class="orange btn-lg"><span>款项</span></div>
        </div>

        <div class="col-md-10">
            <a class="btn btn-small orange" href="#!/commission/index/@{{bookingDetails.id}}">佣金单</a>
            <div class="clear"></div>
            
            <a class="btn btn-small orange" href="#!/claim/index/@{{bookingDetails.id}}">请款单</a>
            <div class="clear"></div>
        </div>
    </div>
</div>