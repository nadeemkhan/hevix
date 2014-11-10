'use strict';

var app = angular.module('app', ['ngResource','ngRoute','ngAnimate']);

app.config(function($routeProvider){
    $routeProvider
        .when('/',
        {
            title: 'Main',
            controller: 'AboutController',
            templateUrl: '/assets/views/main-init.html',
            containerClass: 'index'
        })
        .when('/work/:workId',
        {
            title: 'Works',
            controller: 'WorkController',
            templateUrl: '/assets/views/work-init.html',
            containerClass: 'index33'
        })
        .otherwise({ redirectTo: '/404' });
});