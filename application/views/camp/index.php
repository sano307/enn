<div id="camp" class="row">
    <div class="campMenu large-2 columns">Menu</div>
    <div class="content large-8 columns" back-animation ng-app="camp">
        <div ng-view ng-class="[effect, pageClass]" class="page"></div>
    </div>
    <div class="campRecommand large-2 columns">Recommand</div>
</div>
<script src="<?php echo URL; ?>lib/angular/angular.js"></script>
<script src="<?php echo URL; ?>lib/angular/angular-route.min.js"></script>
<script src="<?php echo URL; ?>lib/angular/angular-animate.min.js"></script>
<script src="<?php echo URL; ?>lib/prism/prism.js"></script>

<script src="<?php echo URL; ?>assets/js/camp/route.js"></script>
<script src="<?php echo URL; ?>assets/js/camp/controller.js"></script>
<script src="<?php echo URL; ?>assets/js/camp/directive.js"></script>