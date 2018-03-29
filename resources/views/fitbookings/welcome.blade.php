<div ng-controller="WelcomeController">
    
    <a href="#!/fitbookings/forms/@{{fitBookingId}}" class="btn btn-info primary-btn">Back</a>
    <div class="clear"></div>
    
    <div class="blackBg">
        <div class="innerBorder">
            <div class="borderBlack">
                <div class="row" ng-show="welcomeSign.welcome_sign_type == 'JW' || welcomeSign.welcome_sign_type == ''">
                    <img src="{{asset("/images/welcome_header.png")}}" alt="" class="img-responsive"/>
                </div>
                
                <div class="row" ng-show="welcomeSign.welcome_sign_type == 'CTrip'">
                    <div class="col-md-3"><img src="{{asset("/images/ctrip_logo2.jpg")}}" alt="" class="img-responsive"/></div>
                    <div class="col-md-6"><img src="{{asset("/images/ctrip_welcome_header.png")}}" alt="" class="img-responsive"/></div>
                </div>
                
                <div class="row" ng-show="welcomeSign.welcome_sign_type == 'FXTrip'">
                    <img src="{{asset("/images/ctrip_welcome_header.png")}}" alt="" class="img-responsive"/>
                </div>
                
                <div class="row body">
                    <div ng-show="welcomeSign.welcome_sign_type != 'FXTrip'">@{{welcomeSign.welcome_sign_text!='' ? welcomeSign.welcome_sign_text : welcomeSign.name}}</div>
                    <img ng-show="welcomeSign.welcome_sign_type == 'FXTrip'" src="{{ asset("/images/fxtrip_logo.png")}}" alt="" class="img-responsive"/>
                </div>

                <div class="row footer">
                    <img src="{{asset("/images/welcome_footer.png")}}" alt="" class="img-responsive"/>
                </div>
            </div>
        </div>
    </div>
</div>