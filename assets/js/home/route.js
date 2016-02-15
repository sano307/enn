var home = angular.module('home', ['ngRoute', 'ngAnimate']);

home.config(function( $routeProvider, $locationProvider ) {
    $routeProvider
        .when('/home', {
            controller: 'indexController',
            templateUrl: 'assets/views/home/index.html'
        })
        .when('/login', {
            controller: 'loginController',
            templateUrl: 'assets/views/home/login.html'
        })
        .when('/join', {
            controller: 'joinController',
            templateUrl: 'assets/views/home/join.html'
        })
        .otherwise({
            redirectTo: '/home'
        });

    $locationProvider.html5Mode(true);
});