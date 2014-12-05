app.directive('contentAnimate', function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            setTimeout(
                function() {
                    $('body').addClass('loaded');
                }, 2000);
        }
    };
});