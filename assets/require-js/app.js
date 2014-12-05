define([
    'angular',
    'angular-route',
    '../js/controllers/index',
    '../js/directives/index'
], function (ng) {
    'use strict';

    return ng.module('app', [
        'app.controllers',
        'app.directives',
        'ngRoute'
    ]);
});