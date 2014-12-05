main.controller('newsController', function($scope, $http) {
  $scope.requestNews = function() {
    $http({
      method: 'GET',
      url: '/news.json'
    }).
    success(function(data) {
      $scope.news = data;
    });
  }
  $scope.requestNews();
});
