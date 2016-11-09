home.controller('indexController', ['$scope', '$location', '$routeParams', '$http', function( $scope, $location, $routeParams, $http ) {
    $scope.effect = 'slidedown';
    $scope.pageClass = 'start';

    $scope.login = function() {
        $location.path("/login");
    };

    $scope.join = function() {
        $location.path("/join");
    };
}]);

home.controller('loginController', ['$scope', '$location', '$routeParams', '$http', '$window', function( $scope, $location, $routeParams, $http, $window ) {
    $scope.effect = 'slidedown';
    $scope.pageClass = 'login';

    $scope.start = function() {
        $location.path("/start");
    };

    $scope.toLogin = function() {
        $http({
            method: 'post',
            url: '/start/toLogin',
            data: {'loginData': $scope.loginData},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function(data, status, headers, config) {
            if ( data.msg === 'success' ) {
                $window.alert('login Success');
                $window.location.href = '/main';
            } else {
                $window.alert('login Failed');
                $scope.loginData.passwd = '';
            }
        }).error(function(data, status, headers, config) {
            console.log(data);
        });
    };
}]);

home.controller('joinController', ['$scope', '$location', '$routeParams', '$http', '$window', function( $scope, $location, $routeParams, $http, $window ) {
    $scope.effect = 'slidedown';
    $scope.pageClass = 'join';

    $scope.start = function() {
        $location.path("/start");
    };

    $scope.countriesInfo = {
        countries: [
            {key: 'korea', name: 'Korea'},
            {key: 'japan', name: 'Japan'}
        ],
        selectedCountry: {key: '', name: 'Country'}
    };

    $scope.regionInfo = {
        regions: [
            {key: '', name: 'Region'}
        ], selectedRegion: {key: '', name: 'Region'}
    };

    $scope.changeCountry = function( selectedCountry ) {
        $scope.countriesInfo.selectedCountry = {key: selectedCountry.key, name:selectedCountry.name};

        // 선택된 국가에 속하는 지역들을 뽑아온다.
        $http({
            method: 'post',
            url: '/start/getWholeRegion',
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function(data, status, headers, config) {
            if( data ) {
                /* 성공적으로 결과 데이터가 넘어 왔을 때 처리 */
                console.log(data);

                $scope.regionInfo.regions = [];
                $scope.regionInfo.selectedRegion = {};

                for ( var iCount in data ) {
                    var str = data[iCount]['nri_region'];
                    var result = str.substring(0, 1).toUpperCase() + str.substring(1, str.length).toLowerCase();
                    $scope.regionInfo.regions[iCount] = {key: data[iCount]['nri_region'], name: result};

                    if ( iCount === 0 ) {
                        $scope.countriesInfo.selectedCountry = {key: selectedCountry.key, name: selectedCountry.name};
                        $scope.regionInfo.selectedRegion = {key: data[iCount]['nri_region'], name: result};
                    }
                }
            }
            else {
                /* 통신한 URL에서 데이터가 넘어오지 않았을 때 처리 */
                console.log(data);
            }
        }).error(function(data, status, headers, config) {
            /* 서버와의 연결이 정상적이지 않을 때 처리 */
            console.log(status);
        });
    };

    $scope.changeRegion = function( selectedRegion ) {
        $scope.regionInfo.selectedRegion = {key: selectedRegion.key, name: selectedRegion.name};
    };

    $scope.toJoin = function() {
        $scope.joinData.country = $scope.countriesInfo.selectedCountry.key;
        $scope.joinData.region = $scope.regionInfo.selectedRegion.key;

        $http({
            method: 'post',
            url: '/start/toJoin',
            data: {'joinData': $scope.joinData},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function (data, status, headers, config) {
            console.log(data.msg);
            switch (data.msg) {
                case 'success': $window.alert("Join Success"); $location.path('/login'); break;
                case 'alreadyID': $window.alert("The Email that is already registered"); break;
                case 'alreadyNickname': $window.alert("The Nickname that is already registered"); break;
                case 'failed': $window.alert("Join Failed"); break;
            }
        }).error(function (data, status, headers, config) {
            console.log(data);
        });
    };
}]);