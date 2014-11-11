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

app.animation('.eachWork', function() {
    return {
        addClass : function(element, className, done) {
            element.addClass('.selected');
            element.prependTo($(".listWork"));
            console.log("fds");
        },
        removeClass : function(element, className, done) {
        }
    }
});

app.controller('WorkController', function($scope, $routeParams) {
    $scope.workId = $routeParams.workId;
});