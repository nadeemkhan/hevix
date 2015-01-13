define(['./module'], function (directives) {
    'use strict';
    directives.directive('feedbackClass', function() {
        return {
            scope: true,
            link: function(scope,element,attrs){
                scope.checkClass = function () {
                    $(element).siblings('div').removeClass('feedback_div-active');
                    $(element).addClass('feedback_div-active');
                }
            }
        }
    });
});