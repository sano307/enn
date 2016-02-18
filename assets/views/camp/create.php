<div class="form_index" ng-controller="createController">
    <div class="section-container tabs" data-section="tabs">
        <section>
            <p class="form_title" data-section-title><a href="#">Create Camp</a></p>

            <div class="form_info" data-section-content>
                <p>
                    <div class="row form-panel" style="color: black; font-weight: bold;">
                        <div class="large-12 columns">
                <p class="welcome">Let's create Camp!</p>

                <form name="campCreateForm" ng-submit="toCreateCamp()" novalidate>
                    <div class="row collapse">
                        <div class="small-2 columns">
                            <span class="prefix"><i class="step fi-social-myspace size-10"></i></span>
                        </div>
                        <div class="small-10 columns">
                            <div id="name_camp" class="create_camp" ng-class="{'has-error': errorCampName}">
                                <input type="text" name="campName" placeholder="Camp Name" ng-model="campData.name"
                                       ng-minlength="4" ng-maxlength="30" required>

                                <p ng-show="campCreateForm.campName.$error.minlength" class="help-block">campname is too
                                    short.</p>

                                <p ng-show="campCreateForm.campName.$error.maxlength" class="help-block">campname is too
                                    long.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="small-2 columns">
                            <span class="prefix"><i class="step fi-web size-12"></i></span>
                        </div>
                        <div class="small-10 columns">
                            <select ng-options="country.name for country in countriesInfo.countries track by country.key"
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
                            <select ng-options="region.name for region in regionInfo.regions track by region.key"
                                    ng-model="regionInfo.selectedRegion"
                                    ng-change="changeRegion(regionInfo.selectedRegion)">
                                <option value="">Region</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="small-11 small-centered columns">
                    <div class="choose">
                        <label>Your Choose</label>
                        <a class="inside" ng-click="camp()" role="button">Back</a>
                        <a class="inside" ng-click="toCreate()" role="button" ng-disabled="campCreateForm.$invalid">Create</a>
                    </div>
                </div>
                <p><span>campData : {{campData}}</span></p>

                <p><span>country : {{countriesInfo.selectedCountry.key}}</span></p>

                <p><span>region : {{regionInfo.selectedRegion.key}}</span></p>
            </div>
        </section>
    </div>
</div>