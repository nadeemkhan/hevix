main.controller('projectsController', function($scope, $http, $stateParams) {

 getProject(); // Load all available tasks

 function getProject(){

 $http.get("views/projects/getProject.php?pageID="+$stateParams.pageID).success(function(data)
	 {
	 	$scope.project = data[0];
	 	console.log($scope.project);
	 });
 };
 
});