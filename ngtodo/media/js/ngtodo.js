function TodoCtrl($scope, $http, $templateCache) {

	// do an ajax request to load the todo list
	$http({
		method : 'GET',
		url : 'index.php?option=com_ngtodo&controller=ajax&view=display'
	}).success(function(data, status, headers, config) {		
		$scope.todos = data; 
		// this callback will be called asynchronously
		// when the response is available
	}).error(function(data, status, headers, config) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	});

	$scope.addTodo = function() {
		$scope.todos.push({
			text : $scope.todoText,
			done : false
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