function TodoCtrl($scope, $http, $cookieStore, $templateCache) {
	
	var project_id = $cookieStore.get('project_id');
	$scope.task_project_id = project_id;
	
	$scope.$on('handleBroadcast', function(event, args) {
		$scope.todos= args.ptasks;
		project_id = args.project_id;		
		$scope.task_project_id = project_id;
    });

	$scope.addTodo = function() {
		var project_id = $cookieStore.get('project_id');
		$scope.task_project_id = project_id;		
		
		$http({
			method : 'POST',
			url : 'index.php?option=com_ngtodo&controller=add&view=tasks',			
			data: {task_name: $scope.todoText, project_id:project_id},				
		 	headers: {'Content-Type': 'application/json'}
		}).success(function(data, status, headers, config) {		
			
			// this callback will be called asynchronously
			// when the response is available
		}).error(function(data, status, headers, config) {
			// called asynchronously if an error occurs
			// or server returns response with an error status.
		});
		
		$scope.todoText = '';
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
}