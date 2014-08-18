admin.controller('adminController', function($scope, $http, $stateParams) {

 getTask(); // Load all available tasks

 function getTask(){
 $http.get("application/getAll.php").success(function(data)
	 {
	 	$scope.tasks = data;
	 });
 };

 $scope.addTask = function (namePage, contentPage) {
	 $http.post("application/add.php?name="+$scope.namePage+"&description="+$scope.contentPage).success(function(data){
	 getTask();
	 $scope.taskInput = "";

	 console.log($scope.contentPage);
	 });
 };

	$scope.deleteTask = function (pageID) {
	 $http.get("application/delete.php?pageID="+pageID).success(function(data){
	 	getTask();
	 });
	};

});



 admin.controller('singlePageAdmin', function($scope, $http, $stateParams) {

 getProject(); // Load all available tasks

 function getProject(){

 $http.get("../views/projects/getProject.php?pageID="+$stateParams.pageID).success(function(data)
	 {
	 	$scope.project = data[0];
	 	console.log($scope.project);
	 });
 };

 $scope.updatePage = function (namePage, contentPage) {
 	console.log(namePage);
 	console.log($stateParams.pageID);

	 $http.post("application/update.php?name="+namePage+"&description="+contentPage+"&pageID="+$stateParams.pageID).success(function(data){
	 			console.log("vd");
	 });
 };
 
});




admin.directive('ngBlur', function() {
  return function( scope, elem, attrs ) {
    elem.bind('blur', function() {
      scope.$apply(attrs.ngBlur);
    });
  };
});