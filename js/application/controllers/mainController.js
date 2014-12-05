main.controller('mainController', function($scope, $route, $log) {
  
  $scope.$on('$routeChangeSuccess', function(){
    $scope.pageTitle = $route.current.pageTitle;
  });
  
});