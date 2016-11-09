<div id="camp" class="row" ng-app="camp">
    <div class="campMenu large-2 columns" ng-controller="menuController">
<!--        <a class="button radius expand" ng-click="camp()">Whole Camp</a>
        <a class="button radius expand" ng-click="myCamp()">My Camp</a>
        <<a class="button radius expand" ng-click="create()" role="button">camp create</a>-->
        <a class="button radius expand" ui-sref="index">Whole Camp</a>
        <a class="button radius expand" ui-sref="create">Create Camp</a>
<!--        <div class="center-row">
            <div class="large-12  columns">
                <ul class="inline-list center">
                    <i class="fi-magnifying-glass"></i>
                    <a href="#" class="search-icon">
                        <li class="search-field"></li>
                    </a>
                    <div class="row collapse">
                        <div class="small-12 columns">
                            <input type="text" class="dream-search" placeholder="Search" ng-model="searchText" ng-keypress="keyPress($event)" required/>
                        </div>
                    </div>
                </ul>
            </div>
        </div>-->
    </div>
    <div class="content large-7 columns" back-animation>
        <div ui-view="campMain" ng-class="[effect, pageClass]" class="page"></div>
    </div>
    <div class="content large-3 columns" back-animation>
        <div ui-view="campOption" ng-class="[effect, pageClass]" class="page"></div>
    </div>
</div>