var camp = angular.module('camp', ['ngRoute', 'ngAnimate']);

camp.config(function( $routeProvider, $locationProvider ) {
    $routeProvider
        .when('/camp', {
            controller: 'indexController',
            templateUrl: 'assets/views/camp/index.php'
        })
        .when('/camp/create', {
            controller: 'createController',
            templateUrl: '/assets/views/camp/create.php'
        })
        .otherwise({
            redirectTo: '/camp'
        });

    $locationProvider.html5Mode(true);
});