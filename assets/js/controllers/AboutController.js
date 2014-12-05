app.controller('AboutController', function($scope, $http) {
    $http.get('data.json')
        .then(function(res){
            //$scope.certificates = res.data.certificates;
        });
    $scope.images = [{
        src: 'compressed/loftblog-en.png',
        title: 'Pic 1'
    }
    ];

});