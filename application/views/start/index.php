<html lang="en" ng-app="home">
<head>
    <meta charset="UTF-8">
    <title>Enn SNS</title>
    <link rel="stylesheet" href="<?php echo URL; ?>/foundation/css/normalize.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/foundation/css/foundation.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/foundation-icons/foundation-icons.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/start/index.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/start/choose.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/public/page_transition.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/start/coin-slider-styles.css" type="text/css">
    <style>
        .ng-valid       {  }
        .ng-invalid     {  }
        .ng-pristine    {  }
        .ng-dirty       {  }
        .ng-touched     {  }

        .join_group .ng-invalid-required        { border: 1px solid red; }
        .join_group .ng-invalid-minlength       { border: 1px solid blue; }
        .join_group .ng-valid-max-length        { border: 1px solid yellow; }
        .login_group .ng-invalid-required        { border: 1px solid red; }
    </style>

    <script src="<?php echo URL; ?>/foundation/js/vendor/modernizr.js"></script>
    <script src="<?php echo URL; ?>/foundation/js/vendor/jquery.js"></script>
    <script src="<?php echo URL; ?>/foundation/js/foundation.min.js"></script>
    <script src="<?php echo URL; ?>/foundation/js/vendor/carousel.js"></script>
    <script src="<?php echo URL; ?>/foundation/js/vendor/coin-slider.min.js"></script>
</head>
<body>
<div class="content" back-animation>
    <div ng-view ng-class="[effect, pageClass]" class="page"></div>
</div>
<script src="<?php echo URL; ?>/lib/angular/angular.js"></script>
<script src="<?php echo URL; ?>/lib/angular/socket.js"></script>
<script src="<?php echo URL; ?>/lib/angular/angular-route.min.js"></script>
<script src="<?php echo URL; ?>/lib/angular/angular-animate.min.js"></script>

<script src="<?php echo URL; ?>/assets/js/start/route.js"></script>
<script src="<?php echo URL; ?>/assets/js/start/controller.js"></script>
<script src="<?php echo URL; ?>/assets/js/start/directive.js"></script>
</body>
</html>