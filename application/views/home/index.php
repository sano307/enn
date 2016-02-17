<html lang="en" ng-app="home">
<head>
    <meta charset="UTF-8">
    <title>Enn SNS</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>foundation/css/normalize.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>foundation/css/foundation.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>foundation-icons/foundation-icons.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main/index.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main/choose.css" type="text/css" />
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

    <script src="<?php echo base_url(); ?>foundation/js/vendor/modernizr.js"></script>
    <script src="<?php echo base_url(); ?>foundation/js/vendor/jquery.js"></script>
    <script src="<?php echo base_url(); ?>foundation/js/foundation.min.js"></script>
</head>
<body>
<div class="content" back-animation>
    <div ng-view ng-class="[effect, pageClass]" class="page"></div>
</div>
<script src="<?php echo base_url(); ?>lib/angular/angular.js"></script>
<script src="<?php echo base_url(); ?>lib/angular/angular-route.min.js"></script>
<script src="<?php echo base_url(); ?>lib/angular/angular-animate.min.js"></script>
<script src="<?php echo base_url(); ?>lib/prism/prism.js"></script>

<script src="<?php echo base_url(); ?>assets/js/home/route.js"></script>
<script src="<?php echo base_url(); ?>assets/js/home/controller.js"></script>
<script src="<?php echo base_url(); ?>assets/js/home/directive.js"></script>
</body>
</html>