app.controller('LatestWorkController', function($scope, $http) {
    $http.get('data.json')
        .then(function(res){
            $scope.works = res.data.works;
        });
});

app.controller('WorkController', function($scope, $routeParams) {
    $scope.workId = $routeParams.workId;
});