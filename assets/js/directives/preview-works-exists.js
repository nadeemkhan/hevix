define(['./module'], function (directives) {
    'use strict';
    directives.directive('previewWorksExists', function() {
    return {
        template: "{{work.url}}";
    };
    });
});

//app.controller('Ctrl', function($scope) {
//    $scope.src ="http://asd.com/asd/asd.jpg";
//});