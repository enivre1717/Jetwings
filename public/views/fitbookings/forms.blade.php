@extends('layouts.app')

@section('title','Forms')

@section('page title','')

@section('content')
<div ng-controller="FormsController">
    <div class="content menu">
        <div class="col-md-1">
            <div class="hot-pink btn-lg"><span>
                <?php //print(FitBookings::model()->getTourCodeBookingID($id)."<br>团队详情"); ?></span></div>
        </div>

        <div class="col-md-10">
            <?php //print(CHtml::link("团队资料",array("fitBooking/detail","id"=>$id),array("class"=>"btn btn-small hot-pink"))); ?>
            <div class="clear"></div>

            <?php //print(CHtml::link("接机牌",array("fitBooking/welcome","id"=>$id),array("class"=>"btn btn-small hot-pink"))); ?>
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
            <?php //print(CHtml::link("离团安全责任书",array("safetyAffirmationResponsibilityContract/index","id"=>$id),array("class"=>"btn btn-small blue"))); ?>
            <div class="clear"></div>
            <?php //print(CHtml::link("自费旅游项目协议书",array("ownExpensesForm/index","id"=>$id),array("class"=>"btn btn-small blue"))); ?>
            <div class="clear"></div>

            <?php //print(CHtml::link("增加/减少景点协议书",array("inStoreForm/index","id"=>$id),array("class"=>"btn btn-small blue"))); ?>
            <div class="clear"></div>
            <?php //print(CHtml::link("意见表",array("feedback/index","id"=>$id),array("class"=>"btn btn-small blue"))); ?>
            <div class="clear"></div>

        </div>

        <div class="clear"></div>

        <?php
            //if(FitBookings::model()->checkHave2ndArrival($id)){
        ?>
        <?php //print(CHtml::link("二次交接与离新确认书",array("arrivalForm/index","id"=>$id),array("class"=>"btn btn-info btn-xlg green"))); ?>
        <?php //}//if have 2nd arrival ?>

        <div class="clear"></div>

        <div class="col-md-1">
            <div class="orange btn-lg"><span>款项</span></div>
        </div>

        <div class="col-md-10">
            <?php //print(CHtml::link("佣金单",array("commission/index","id"=>$id),array("class"=>"btn btn-small orange"))); ?>
            <div class="clear"></div>

            <?php //print(CHtml::link("请款单",array("claim/index","id"=>$id),array("class"=>"btn btn-small orange"))); ?>
            <div class="clear"></div>
        </div>
    </div>
</div>
@endsection