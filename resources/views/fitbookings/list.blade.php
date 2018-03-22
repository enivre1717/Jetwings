<h1>团列表</h1>
<div ng-controller="FitBookingsController">
    <div class="row">
            <form name="BookingFilter" id="BookingFilter" action="" method="post">
                <div class="col-md-2">日期 (日/月/年):</div>
                <div class="col-md-1">由:</div>
                <div class="col-md-1">
                    <input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" is-open="isDateFromFilterOpened" datepicker-options="dateOptions" ng-click="openDateFromFilter()" ng-model="filter.dateFrom" />
                </div>
                <div class="col-md-1">至:</div>
                <div class="col-md-1">
                    <input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" is-open="isDateToFilterOpened" datepicker-options="dateOptions" ng-click="openDateToFilter()" ng-model="filter.dateTo" />
                </div>
                <div class="col-md-1">
                    <input type="button" class="btn btn-info" value="Filter" ng-click="filterBookings(filter);"/>
                </div>
            </form>
        </div>

    <div class="row">&nbsp;</div>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover bookings">
            <tr>
                <th>
                    团号
                </th>
                <th>
                    组团社
                </th>
                <th>
                    领队
                </th>
                <th>
                    人数
                </th>
                <th>
                    车牌
                </th>
                <th>
                   抵达日期
                </th>
                <th>
                    离境日期
                </th>
                <th>
                    酒店
                </th>
                <th>
                    导游请款
                </th>
            </tr>

            <tr ng-repeat="bookings in fitbookings" ng-click="fitbookingDetails(bookings.fitbookings.id);">
                <td>@{{bookings.fitbookings.tour_code}}</td>
                <td>@{{bookings.fitbookings.company_name}}</td>
                <td>@{{bookings.fitbookings.tour_leader}}</td>
                <td>@{{bookings.fitbookings.pax_update}}/@{{bookings.fitbookings.pax}}</td>
                <td>
                    <div class="row tour-guide" ng-if="bookings.fitTransports.length > 0">
                        <div class="row">
                            <div class="col-md-5">车牌号码:</div>
                            <div class="col-md-5">@{{bookings.fitTransports[0].agency}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">联络电话:</div>
                            <div class="col-md-5">@{{bookings.fitTransports[0].contact_no}}</div>
                        </div>
                        <div class="row">
                                <div class="col-md-5"><strong>司机小费:</strong></div>
                                <div class="col-md-5"><strong>$ @{{bookings.fitTransports[0].driver_tips}}</strong></div>
                        </div>
                    </div>
                </td>
                <td>
                     <div class="row flight" ng-repeat="arrivals in bookings.fitFlights">
                        <div class="row" ng-if="arrivals.type == 'Arrival'">
                            <div class="col-md-5">入境日期:</div>
                            <div class="col-md-5">@{{arrivals.arrival_at | formatDate:"D/MM/Y"}}</div>
                        </div>
                        <div class="row" ng-if="arrivals.type == 'Arrival'">
                            <div class="col-md-5">航班号:</div>
                            <div class="col-md-5">@{{arrivals.flight_no}}</div>
                        </div>
                        <div class="row" ng-if="arrivals.type == 'Arrival'">
                            <div class="col-md-5">入境时间:</div>
                            <div class="col-md-5">@{{arrivals.arrival_at!='' ? (arrivals.arrival_at| formatDate:"HH:mm") : arrivals.arrival_at_1}}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row flight" ng-repeat="departures in bookings.fitFlights">
                        <div class="row" ng-if="departures.type == 'Departure'">
                            <div class="col-md-5">入境日期:</div>
                            <div class="col-md-5">@{{departures.departure_at | formatDate:"D/MM/Y"}}</div>
                        </div>
                        <div class="row" ng-if="departures.type == 'Departure'">
                            <div class="col-md-5">航班号:</div>
                            <div class="col-md-5">@{{departures.flight_no}}</div>
                        </div>
                        <div class="row" ng-if="departures.type == 'Departure'">
                            <div class="col-md-5">入境时间:</div>
                            <div class="col-md-5">@{{departures.departure_at!='' ? (departures.departure_at| formatDate:"HH:mm") : departures.departure_at_1}}</div>
                        </div>
                    </div>
                </td>
                <td class="hotel">
                    <div class="row" ng-repeat="hotels in bookings.fitHotels">
                        @{{hotels.name}}
                    </div>
                </td>
                <td>
                    @{{bookings.hasClaim==true ? "已提交" : "未提交"}}
                </td>
            </tr>
            <?php //}//for ?>
        </table>
    </div>
</div>