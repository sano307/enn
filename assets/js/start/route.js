var home = angular.module('home', ['ngRoute', 'ngAnimate']);

home.config(function( $routeProvider, $locationProvider ) {
    $routeProvider
        .when('/start', {
            controller: 'indexController',
            templateUrl: 'assets/views/start/index.php'
        })
        .when('/login', {
            controller: 'loginController',
            templateUrl: 'assets/views/start/login.html'
        })
        .when('/join', {
            controller: 'joinController',
            templateUrl: 'assets/views/start/join.html'
        })
        .otherwise({
            redirectTo: '/start'
        });

    $locationProvider.html5Mode(true);
});