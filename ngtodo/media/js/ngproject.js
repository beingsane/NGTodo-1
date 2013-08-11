var myApp = angular.module('myApp', []);

myApp.run(function($rootScope) {
    /*
        Receive emitted message and broadcast it.
        Event names must be distinct or browser will blow up!
    */
    $rootScope.$on('handleEmit', function(event, args) {
        $rootScope.$broadcast('handleBroadcast', args);
    });
});

function ProjectCtrl($scope, $http, $cookieStore, $templateCache) {

	// do an ajax request to load the todo list
	$http({
		method : 'GET',
		url : 'index.php?option=com_ngtodo&controller=ajax&view=projects'
	}).success(function(data, status, headers, config) {		
		$scope.projects = data; 
		// this callback will be called asynchronously
		// when the response is available
	}).error(function(data, status, headers, config) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	});

	$scope.addProject = function() {
		
		//add first in the database
		var text = $scope.projectText;
		$http({
			method : 'POST',
			url : 'index.php?option=com_ngtodo&controller=add&view=projects',			
			data: {project_name: $scope.projectText},				
		 	headers: {'Content-Type': 'application/json'}
		}).success(function(data, status, headers, config) {		
			$scope.projects.push({
				project_name: text			
			});
			// this callback will be called asynchronously
			// when the response is available
		}).error(function(data, status, headers, config) {
			// called asynchronously if an error occurs
			// or server returns response with an error status.
		});
		
		
		
		$scope.projectText = '';
	};

	$scope.remaining = function() {
		var count = 0;
		angular.forEach($scope.todos, function(todo) {
			count += todo.done ? 0 : 1;
		});
		return count;
	};

	$scope.archive = function() {
		var oldTodos = $scope.todos;
		$scope.todos = [];
		angular.forEach(oldTodos, function(todo) {
			if (!todo.done)
				$scope.todos.push(todo);
		});
	};
	
	$scope.fetch = function(project_id) {
		
		$http({
			method : 'POST',
			url : 'index.php?option=com_ngtodo&controller=ajax&view=tasks',			
			data: {project_id: project_id},				
		 	headers: {'Content-Type': 'application/json'}
		}).success(function(data, status, headers, config) {
			
			$scope.$emit('handleEmit', {project_id: project_id, ptasks:data});
			//console.log(project_id);
			//$scope.tasks = data;
			$cookieStore.put('project_id', project_id);			
			// this callback will be called asynchronously
			// when the response is available
		}).error(function(data, status, headers, config) {
			// called asynchronously if an error occurs
			// or server returns response with an error status.
		});		
		
	};
}