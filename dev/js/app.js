'use strict';

var main = angular.module('main', ['ngResource', 'ngRoute', 'angular-carousel', 'ui.router']);

main.config(function($stateProvider) {
  $stateProvider
    .state('index', {
      url: "",
      title: 'Main',
      containerClass: 'index',
      templateUrl: 'views/main/content.html',
      controller: 'newsController'
    })
    .state('project', {
      url: "/project/:pageID",
      containerClass: 'projects',
      templateUrl: 'views/projects/pageProject.html',
      controller: 'projectsController'
    });
})

main.run(function($rootScope) {
  $rootScope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams) {
    $rootScope.containerClass = toState.containerClass;
    $rootScope.title = toState.title;
  });
})

// texpos_toropanov
// texpos_umain
// [CVGDgD@[Z6z

// tor_bookmarks
//  - id
//  - url
//  - description
//  - keywords
