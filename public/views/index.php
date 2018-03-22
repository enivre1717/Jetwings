<!DOCTYPE html>
<html ng-app="myApp">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="language" content="en" />
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="images/logo_mobile.jpg" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/logo_mobile.jpg" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/logo_mobile.jpg" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/logo_mobile.jpg" />
        
        <link rel="icon" type="image/png" href="logo.ico"/>
        
        <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="js/bootstrap-3.3.5/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui.js" type="text/javascript"></script>
        <script src="js/angular.min.js" type="text/javascript"></script>
        <script src="js/ui-bootstrap-2.5.0.min.js" type="text/javascript"></script>
        <script src="js/ui-bootstrap-tpls-2.5.0.min.js" type="text/javascript"></script>
        <script src="js/moment-with-locales.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
        <script src="js/angular-cookies.min.js"></script>
        <script src="js/app/main.js" type="text/javascript"></script>
        
        <script src="js/app/controllers/LoginController.js" type="text/javascript"></script>
        <script src="js/app/controllers/FitBookingsController.js" type="text/javascript"></script>
        <script src="js/app/controllers/FormsController.js" type="text/javascript"></script>
        
        <script src="js/app/models/tourguideModel.js" type="text/javascript"></script>
        <script src="js/app/models/fitbookingsModel.js" type="text/javascript"></script>
        <script src="js/app/models/fitTransportsModel.js" type="text/javascript"></script>
        
        <link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="js/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/components.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-extend.css" rel="stylesheet" type="text/css"/>
        <link href="js/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="js/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        
        <title>JetWings International Pte Ltd</title>
    </head>
    <body>
        <div class="container-fluid">

            <div id="header">
                <div id="logo" class="img-responsive">
                    <a href="">
                        <img src="images/Jetwings_logo.jpg" alt=""/>
                    </a>
                </div>
                
                <div class="settings">
                    <a href="logout">Logout</a>
                </div>
                
                
            </div><!-- header -->
            
            <div class="clear"></div>
            <div class="content">
                <ng-view></ng-view>
            </div>
        </div>
    </body>
</html>