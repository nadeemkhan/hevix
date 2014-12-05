app.controller('LatestWorkController', function($scope, $http, $element) {
    $http.get('data.json')
        .then(function(res){
            $scope.works = res.data.works;
        });

    $scope.showWork= function(item) {
        $scope.selected = item;
    };

    $scope.isActive = function(item) {
        return $scope.selected === item;
    };
});

//app.animation('.eachWork', function() {
//    return {
//        addClass : function(element, className, done) {
//
//            element.parent().addClass('selected');
//            setTimeout(function() {
//                element.prependTo($(".listWork"));
//                element.parent().addClass('opened');
//            }, 500);
//
//            setTimeout(function() {
//                element.addClass('selected');
//                element.addClass('opened');
//            }, 600);
//
//        },
//        removeClass : function(element, className, done) {
//            setTimeout(function() {
//                element.parent().removeClass('selected');
//            }, 0);
//            setTimeout(function() {
//                element.parent().addClass('selected');
//            }, 100);
//            setTimeout(function() {
//                element.removeClass('selected');
//            }, 400);
//
//
//        }
//    }
//});
//
//app.controller('WorkController', function($scope, $routeParams) {
//    $scope.workId = $routeParams.workId;
//});