app.controller('AboutController', function($scope, $http) {
    $http.get('data.json')
        .then(function(res){
            //$scope.certificates = res.data.certificates;
        });
    $scope.images = [{
        src: 'loftblog.jpg',
        title: 'Pic 1'
    }, {
        src: 'certificate.jpg',
        title: 'Pic 2'
    }, {
        src: 'certificate3.jpg',
        title: 'Pic 2'
    }, {
        src: 'certificate2.jpg',
        title: 'Pic 3'
    }];

});