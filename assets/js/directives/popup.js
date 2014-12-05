app.directive('magnificPopup', function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            $('.pop-up').magnificPopup({
                type: 'image',
                overflowY: 'scroll',
                alignTop: true,
                closeOnContentClick: true,
                showCloseBtn: false
            });
        }
    };
});