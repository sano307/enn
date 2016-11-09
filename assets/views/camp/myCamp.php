<div ng-controller="myCampController" style="color: black;">
    <div class="row">
        <div class="large-12 columns">
            <div class="form_index" style="height: 50px;">
                <div class="section-container tabs" data-section="tabs">
                    <p class="form_title" data-section-title><a href="#">My Camp List</a></p>
                </div>
            </div>
<!--            <div class="small-12 columns">
                <input type="text" />
            </div>-->
            <div class="small-12 columns" ng-repeat="myCamp in myCampInfo">
                <div class="small-6 columns">
                    <!--<img src="/public/img/camp/{{myCamp.c_idx}}/{{myCamp.c_campImgName}}.{{myCamp.c_campImgExt}}" />-->
                    <a ng-click="goCamp(myCamp[0].c_idx)">
                        <img ng-src="/public/img/camp/{{myCamp[0].c_idx}}/{{myCamp[0].c_campImgName}}.{{myCamp[0].c_campImgExt}}" style="width: 150px; height: 150px; border-radius: 50%;" ng-show="myCampInfo"/>
                    </a>
                </div>
                <div class="small-6 columns">
                    <span style="font-weight: bold; font-size: 14px; font-style: italic;">{{myCamp[0].c_campName}}</span><br/>
                    <span>{{myCamp[0].c_campCountry}}, {{myCamp[0].c_campRegion}}</span>
                </div>
            </div>
        </div>
    </div>
</div>