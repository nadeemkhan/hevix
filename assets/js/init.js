'use strict';

var app = angular.module('app', ['ngResource','ngRoute','ngAnimate']);

app.config(function($routeProvider){
    $routeProvider
        .when('/',
        {
            title: 'Main',
            controller: 'AboutController',
            templateUrl: '/assets/views/main-init.html',
            containerClass: 'main-page'
        })
        .when('/work/:workId',
        {
            title: 'Works',
            controller: 'WorkController',
            templateUrl: '/assets/views/work-init.html',
            containerClass: 'works-page'
        })
        .otherwise({ redirectTo: '/404' });
});

app.run(['$location', '$rootScope', function($location, $rootScope) {
    $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
        $rootScope.title = current.$$route.title;
        $rootScope.containerClass = current.$$route.containerClass;
    });
}]);