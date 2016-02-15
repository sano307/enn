home.controller('indexController', ['$scope', '$location', '$routeParams', '$http', function( $scope, $location, $routeParams, $http ) {
    $scope.effect = 'slidedown';
    $scope.pageClass = 'home';

    $scope.login = function() {
        $location.path("/login");
    };

    $scope.join = function() {
        $location.path("/join");
    };
}]);

home.controller('loginController', ['$scope', '$location', '$routeParams', '$http', function( $scope, $location, $routeParams, $http ) {
    $scope.effect = 'Fade in/out';
    $scope.pageClass = 'login';

    $scope.home = function() {
        $location.path("/home");
    };
}]);

home.controller('joinController', ['$scope', '$location', '$routeParams', '$http', function( $scope, $location, $routeParams, $http ) {
    $scope.effect = 'Fade in/out';
    $scope.pageClass = 'join';

    $scope.home = function() {
        $location.path("/home");
    };
}]);