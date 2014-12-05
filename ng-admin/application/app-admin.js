'use strict';

var admin = angular.module('admin', ['ngResource', 'ngRoute', 'ui.router', 'textAngular']);

 admin.config(function($stateProvider){
    $stateProvider
        .state('index', {
            url: "",
            templateUrl: 'views/index.html',
            controller: 'adminController'
        })
        .state('add', {
            url: "/add",
            templateUrl: 'views/add.html',
            controller: 'adminController'
        })
        .state('page', {
            url: "/page/:pageID",
            templateUrl: 'views/page.html',
            controller: 'singlePageAdmin'
        });
 })

// texpos_toropanov
// texpos_umain
// [CVGDgD@[Z6z

// tor_bookmarks
// 	- id
// 	- url
// 	- description
// 	- keywords