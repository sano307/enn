<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test SignUp</title>
    <style>
        .ng-valid       {  }
        .ng-invalid     {  }
        .ng-pristine    {  }
        .ng-dirty       {  }
        .ng-touched     {  }

        .join_group .ng-invalid-required        { border: 1px solid red; }
        .join_group .ng-invalid-minlength       { border: 1px solid blue; }
        .join_group .ng-valid-max-length        { border: 1px solid yellow; }
    </style>
</head>
<body ng-app="myApp" ng-controller="formCtrl">
<form name="joinForm" ng-submit="toJoin()" novalidate>
    <div id="id_group" class="join_group" ng-class="{'has-error': joinForm.email.$invalid && !joinForm.email.$pristine }">
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" ng-model="joinData.email" required>
        <p ng-show="joinForm.email.$invalid && !joinForm.email.$pristine">You email is required.</p>
    </div>

    <div id="passwd_group" class="join_group">
        <label>Passwd</label>
        <input type="text" name="passwd" placeholder="Password" ng-model="joinData.passwd" ng-minlength="8" ng-maxlength="20" required>
        <p ng-show="joinForm.passwd.$error.minlength" class="help-block">password is too short.</p>
        <p ng-show="joinForm.passwd.$error.maxlength" class="help-block">password is too long.</p>
    </div>

    <div id="passwd_group" class="join_group" ng-class="{'has-error': errorNickname}">
        <label>Nickname</label>
        <input type="text" name="nickname" placeholder="Nickname" ng-model="joinData.nickname" ng-minlength="5" ng-maxlength="30" required>
        <p ng-show="joinForm.nickname.$error.minlength" class="help-block">nickname is too short.</p>
        <p ng-show="joinForm.nickname.$error.maxlength" class="help-block">nickname is too long.</p>
    </div>

    <button type="submit" ng-disabled="joinForm.$invalid">Join</button>
</form>

<pre>{{ joinData }}</pre>
<script src="<?php echo base_url(); ?>foundation/js/vendor/jquery.js"></script>
<script src="<?php echo base_url(); ?>lib/angular/angular.js"></script>
<script>
    var myApp = angular.module('myApp', []);

    myApp.controller('formCtrl', ['$scope', function( $scope, $http ) {
        $scope.joinData = {};

        $scope.toJoin = function() {
            $http({
                method: 'post',
                url: '/test/toJoin',
                data: $.param($scope.joinData),
            });
        };
    }]);
</script>
</body>
</html>