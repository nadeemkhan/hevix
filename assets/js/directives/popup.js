define(['./module', 'magnific-popup'], function (directives) {
    'use strict';
    directives.directive('magnificPopup', function() {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                $( document ).ready(function() {
                    $('.pop-up').magnificPopup({
                        type: 'image',
                        overflowY: 'scroll',
                        alignTop: true,
                        closeOnContentClick: true,
                        showCloseBtn: false
                    });
                });
            }
        };
    });
});