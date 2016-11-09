var camp = angular.module('camp', ['ui.router', 'ngAnimate', 'ngFileUpload', 'btford.socket-io', 'mm.foundation']);

var serverBaseUrl = 'http://127.0.0.1:3000';

camp.factory('socket', function (socketFactory) {
    var myIoSocket = io.connect(serverBaseUrl);

    var socket = socketFactory({
        ioSocket: myIoSocket
    });

    return socket;
});

camp.config(function( $stateProvider, $locationProvider, $urlRouterProvider ) {
    $stateProvider
        .state('index', {
            url: '/camp',
            views: {
                'campMain': {
                    controller: 'indexController',
                    templateUrl: '/assets/views/camp/index.php'
                },
                'campOption': {
                    controller: 'myCampController',
                    templateUrl: '/assets/views/camp/myCamp.php'
                }
            }
        })
        .state('create', {
            url: '/camp/create',
            views: {
                'campMain': {
                    controller: 'createController',
                    templateUrl: '/assets/views/camp/create.php'
                },
                'campOption': {
                    controller: 'recommendController',
                    templateUrl: '/assets/views/camp/recommend.php'
                }
            }
        })
        .state('enter', {
            url: '/camp/:c_idx',
            views: {
                'campMain': {
                    controller: 'campController',
                    templateUrl: '/assets/views/camp/camp.php'
                },
                'campOption': {
                    controller: 'chatController',
                    templateUrl: '/nodejs/public/chat.php'
                }
            }
        })
        .state('joinManager', {
            url: '/camp/:c_idx/joinManager',
            views: {
                'campMain': {
                    controller: 'campJoinController',
                    templateUrl: '/assets/views/camp/campJoinManagement.php'
                }
            }
        });

    $urlRouterProvider.otherwise('/camp');
    $locationProvider.html5Mode(true);
});
/*
camp.config(function( $routeProvider, $locationProvider ) {
    $routeProvider
        .when('/camp', {
            controller: 'indexController',
            templateUrl: '/assets/views/camp/index.php'
        })
        .when('/camp/create', {
            controller: 'createController',
            templateUrl: '/assets/views/camp/create.php'
        })
        .when('/camp/myCamp', {
            controller: 'myCampController',
            templateUrl: '/assets/views/camp/myCamp.php'
        })
        .when('/camp/:c_idx', {
            controller: 'campController',
            templateUrl: '/assets/views/camp/camp.php'
        })
        .otherwise({
            redirectTo: '/camp'
        });

    $locationProvider.html5Mode(true);
});*/


