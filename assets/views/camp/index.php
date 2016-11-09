<div ng-controller="indexController" style="color: black;">
    <div class="row">
        <div class="large-12 columns">
            <div class="form_index">
                <div class="section-container tabs" data-section="tabs">
                    <p class="form_title" data-section-title><a href="#">Camp Search</a></p>

                    <div class="form_info" data-section-content>
                        <p>
                            <div class="row form-panel" style="color: black; font-weight: bold;">
                                <div class="large-12 columns">
                                    <div class="row collapse">
                                        <div class="small-2 columns">
                                            <span class="prefix"><i class="step fi-web size-12"></i></span>
                                        </div>
                                        <div class="small-10 columns">
                                            <select
                                                ng-options="country.name for country in countriesInfo.countries track by country.key"
                                                ng-model="countriesInfo.selectedCountry"
                                                ng-change="changeCountry(countriesInfo.selectedCountry)">
                                                <option value="">Country</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row collapse">
                                        <div class="small-2 columns">
                                            <span class="prefix"><i class="step fi-foot size-12"></i></span>
                                        </div>
                                        <div class="small-10 columns">
                                            <select
                                                ng-options="region.name for region in regionInfo.regions track by region.key"
                                                ng-model="regionInfo.selectedRegion"
                                                ng-change="changeRegion(regionInfo.selectedRegion)">
                                                <option value="">Region</option>
                                            </select>
                                        </div>
                                    </div>
 <!--                       <p>country : {{countriesInfo.selectedCountry.key}}</p>

                        <p>region : {{regionInfo.selectedRegion.key}}</p>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Third Band (Image Right with Text) -->
    <div class="row">
        <div class="large-12 columns">
            <div class="form_index" style="height: 100px;">
                <div class="section-container tabs" data-section="tabs">
                    <p class="form_title" data-section-title><a href="#">Camp List</a></p>
                </div>
            </div>
            <div class="small-3 columns" ng-repeat="camp in campInfo">
                <div class="image-wrapper overlay-fade-in">
                    <a ng-click="goCamp(camp.c_idx)">
<!--                        <img src="https://tourneau.scene7.com/is/image/tourneau/DEV9900004?hei=450&wid=300&fmt=png-alpha&resMode=bicub&op_sharpen=1" />
-->                     <img ng-src="/public/img/camp/{{camp.c_idx}}/{{camp.c_campImgName}}.{{camp.c_campImgExt}}" style="width: 450px; height: 300px;"/>
                        <div class="image-overlay-content">
                            <h2>{{camp.cm_theNumber}}</h2>

                            <p class="price" style="font-size: 20px; font-weight: bold;">{{camp.c_campIntroduction}}</p>
                            <a class="button" ng-click="join(camp.c_idx)" data="" ng-show="!(camp.cm_joinStateCamp==1)">Join</a>
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
