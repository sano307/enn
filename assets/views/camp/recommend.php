<div ng-controller="recommendController" style="color: black;">
    <div class="row">
        <div ng-repeat="region in regionInfo">
            {{region.nri_nation}}, {{region.nri_region}} : {{region.c_campNumber[0].c_campNumber}}
        </div>
    </div>
</div>