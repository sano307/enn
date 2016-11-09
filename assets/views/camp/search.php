<div ng-controller="campSearchController">
    <div class="row">
        <div class="large-12 columns">
            <div class="form_index" style="height: 100px;">
                <div class="section-container tabs" data-section="tabs">
                    <p class="form_title" data-section-title><a href="#">Camp Search Result</a></p>
                </div>
            </div>
            <div class="small-3 columns" ng-repeat="camp in campInfo">
                <div class="image-wrapper overlay-fade-in">
                    <a ng-click="goCamp(camp.c_idx)">
                        <!--                        <img src="https://tourneau.scene7.com/is/image/tourneau/DEV9900004?hei=450&wid=300&fmt=png-alpha&resMode=bicub&op_sharpen=1" />
                        -->                     <img src="/public/img/camp/{{camp.c_idx}}/{{camp.c_campImgName}}.{{camp.c_campImgExt}}" style="width: 450px; height: 300px;"/>
                        <div class="image-overlay-content">
                            <h2>{{camp.cm_theNumber}}</h2>

                            <p class="price" style="font-size: 20px; font-weight: bold;">{{camp.c_campIntroduction}}</p>
                            <a href="#" class="button" ng-click="join(camp.c_idx)" data=""
                               ng-show="!camp.cm_joinStateCamp">Join</a>
                        </div>
                    </a>
                </div>
                <span style="font-weight: bold; font-size: 14px; font-style: italic;">{{camp.c_campName}}</span><br/>
                {{camp.c_campCountry}}, {{camp.c_campRegion}}
            </div>
            <a ng-click="loadCamp()" ng-show="camp">Click</a>
        </div>
    </div>
</div>