<form ng-submit="login(user);" ng-controller="LoginController" class="j-forms" id="tourguide-login-form" method="post">
        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <div class="row">
            <div class="input">
                <label class="icon-left" for="password">
                    <i class="fa fa-envelope-o"></i>
                </label>
                <input class="form-control" placeholder="Username" ng-model="user.username" type="text" />
                <div class="alert alert-danger" ng-show="errors.username">{{errors.username[0]}}</div>
            </div>
        </div>

        <div class="row">
            <div class="input">
                <label class="icon-left" for="password">
                    <i class="fa fa-lock"></i>
                </label>
                <input class="form-control" placeholder="Password" ng-model="user.password" type="password" />
                <div class="alert alert-danger" ng-show="errors.password">{{errors.password[0]}}</div>
            </div>
        </div>

        <div class="row submit">
                <input class="btn btn-info primary-btn" type="submit" value="Login" />            
        </div>

</form>