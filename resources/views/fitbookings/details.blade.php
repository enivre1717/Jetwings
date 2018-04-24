<div ng-controller="FitBookingsDetailsController">
    
    <a href="#!/fitbookings/forms/@{{fitbookings.id}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>
    
    <div class="row header">团队资料</div>
        <div class="row tour-details">
            <div class="col-md-8">
                <div class="row green table-responsive">
                    <table class="table">
                        <th>团号</th>
                        <th>组团社</th>
                        <th>领队</th>
                        <th>人数</th>
                        <th>车牌</th>
                        <th>组团社备注</th>
                        <tr>
                            <td>@{{fitbookings.tour_code}}</td>
                            <td>@{{fitbookings.company_name}}</td>
                            <td>@{{fitbookings.tour_leader}}</td>
                            <td>@{{fitbookings.pax_update}}/@{{fitbookings.pax}}</td>
                            <td>
                                <div ng-repeat="transport in fitbookings.transports">
                                    <div class="row">@{{transport.transport_agencies.name}}</div>
                                    <div class="row">@{{transport.transports.tel}}</div>
                                    <div class="row">
                                        <div class="col-md-7"><strong>司机小费:</strong></div>
                                        <div class="col-md-5"><strong>@{{transport.driver_tips| currency : "$" : 2}}</strong></div>
                                    </div>
                                </div>
                            </td>
                            <td><!-- 组团社备注--></td>
                        </tr>
                    </table>
                </div>

                <div class="row yellow table-responsive">
                    <table class="table">
                        <th>酒店名字</th>
                        <th>入住日期</th>
                        <th>退房日期</th>
                        <th>房数</th>
                        <th>酒店确认号</th>
                        <th>酒店备注</th>
                        <tr ng-repeat="hotel in hotels">
                            <td>@{{hotel[$index].hotels.name}}</td>
                            <td>@{{hotel[$index].check_in}}</td>
                            <td>@{{hotel[$index].check_out}}</td>
                            <td>@{{hotel[$index].hotel_qty}}@{{hotel[$index].hotel_qty ? '间' : ''}}</td>
                            <td>&nbsp;</td>
                            <td>@{{hotel[$index].remarks}}</td>
                        </tr>
                    </table>
                </div>

                <div class="row green table-responsive">
                    <table class="table" ng-show="fitbookings.calls[0] || fitbookings.calls[1]">
                        <th>行程</th>
                        <th>抵达航班</th>
                        <th>离境航班</th>
                        <th>二次入新</th>
                        <th>二次离新</th>
                        <th>行程/车子备注</th>
                        <tr>
                            <td>@{{fitbookings.type}}<?php //print($bookingModel["type"]); ?></td>
                            <td>
                                <div ng-show="fitbookings.calls[0].flights[0]">
                                    <div class="row">
                                        <div class="col-md-5">入境日期:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[0].flights[0].arrival_at | formatDate: 'DD/MM/YYYY'}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">航班号:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[0].flights[0].flight_no}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">入境时间:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[0].flights[0].arrival_at_1 ? fitbookings.calls[0].flights[0].arrival_at_1 : fitbookings.calls[0].flights[0].arrival_at}}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div ng-show="fitbookings.calls[0].flights[1]">
                                    <div class="row">
                                        <div class="col-md-5">出境日期:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[0].flights[1].departure_at | formatDate: 'DD/MM/YYYY'}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">航班号:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[0].flights[1].flight_no}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">出境时间:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[0].flights[1].departure_at_1 ? fitbookings.calls[0].flights[1].departure_at_1 : fitbookings.calls[0].flights[1].departure_at}}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div ng-show="fitbookings.calls[1].flights[0]">
                                    <div class="row">
                                        <div class="col-md-5">入境日期:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[1].flights[0].arrival_at | formatDate: 'DD/MM/YYYY'}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">航班号:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[1].flights[0].flight_no}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">入境时间:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[1].flights[0].arrival_at_1 ? fitbookings.calls[1].flights[0].arrival_at_1 : flight.flights[0].arrival_at}}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div ng-show="fitbookings.calls[1].flights[1]">
                                    <div class="row">
                                        <div class="col-md-5">出境日期:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[1].flights[1].departure_at | formatDate: 'DD/MM/YYYY'}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">航班号:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[1].flights[1].flight_no}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">出境时间:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[1].flights[1].departure_at_1 ? fitbookings.calls[1].flights[1].departure_at_1 : fitbookings.calls[1].flights[1].departure_at}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="width15">
                                <div class="row" ng-repeat="transport in fitbookings.transports">
                                    <p style="white-space: pre;">@{{transport.remarks}}</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    
                    <table class="table" ng-show="fitbookings.calls[2] || fitbookings.calls[3]">
                        <th>行程</th>
                        <th>三次入新</th>
                        <th>三次离新</th>
                        <th>四次入新</th>
                        <th>四次离新</th>
                        <th>&nbsp;</th>
                        <tr>
                            <td>@{{fitbookings.type}}</td>
                            <td>
                                <div ng-show="fitbookings.calls[2].flights[0]">
                                    <div class="row">
                                        <div class="col-md-5">入境日期:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[2].flights[0].arrival_at | formatDate: 'DD/MM/YYYY'}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">航班号:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[2].flights[0].flight_no}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">入境时间:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[2].flights[0].arrival_at_1 ? fitbookings.calls[2].flights[0].arrival_at_1 : fitbookings.calls[2].flights[0].arrival_at}}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div ng-show="fitbookings.calls[2].flights[1]">
                                    <div class="row">
                                        <div class="col-md-5">入境日期:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[2].flights[1].departure_at | formatDate: 'DD/MM/YYYY'}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">航班号:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[2].flights[1].flight_no}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">入境时间:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[2].flights[1].departure_at_1 ? fitbookings.calls[2].flights[0].departure_at_1 : fitbookings.calls[2].flights[0].departure_at}}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div ng-show="fitbookings.calls[3].flights[0]">
                                    <div class="row">
                                        <div class="col-md-5">入境日期:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[3].flights[0].arrival_at | formatDate: 'DD/MM/YYYY'}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">航班号:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[3].flights[0].flight_no}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">入境时间:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[3].flights[0].arrival_at_1 ? fitbookings.calls[3].flights[0].arrival_at_1 : fitbookings.calls[3].flights[0].arrival_at}}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div ng-show="fitbookings.calls[3].flights[1]">
                                    <div class="row">
                                        <div class="col-md-5">入境日期:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[3].flights[1].departure_at | formatDate: 'DD/MM/YYYY'}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">航班号:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[3].flights[1].flight_no}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">入境时间:</div>
                                        <div class="col-md-5">@{{fitbookings.calls[3].flights[1].departure_at_1 ? fitbookings.calls[2].flights[0].departure_at_1 : fitbookings.calls[2].flights[0].departure_at}}</div>
                                    </div>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    
                </div>

            </div>
            <div class="col-md-4">
                <div class="row remarks" ng-bind-html="fitbookings.remarks | html"></div>
            </div>
        </div>
    
</div>