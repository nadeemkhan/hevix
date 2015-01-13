define(['./module'], function (directives) {
    'use strict';
    directives.directive('feedbackClasses', function() {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                $(element).click(function() {
                    if(!$(element).hasClass("feedback_div-active")) {
                        $("#feedback > div").removeClass("feedback_div-active");
                        $(element).addClass("feedback_div-active");
                    }
                });
            }
        };
    });
});