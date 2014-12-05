define(['./app'], function (app) {
    'use strict';
    return app.config(function($routeProvider){
        $routeProvider
            .when('/',
            {
                title: 'Main',
                controller: 'AboutController',
                templateUrl: '/assets/views/main-init.html',
                containerClass: 'main-page'
            })
            .when('/works',
            {
                title: 'Works',
                controller: 'WorkController',
                templateUrl: '/assets/views/works-init.html',
                containerClass: 'works-page'
            })
            .otherwise({ redirectTo: '/404' });
    });
});