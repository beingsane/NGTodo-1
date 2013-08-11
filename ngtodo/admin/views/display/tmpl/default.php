<?php
NGTodoHelpersHtml::loadNGFiles ( 'ngproject' );
NGTodoHelpersHtml::loadNGFiles ( 'ngtodo' );
?>
<div class="ngtodo">
<div class="row-fluid">
	<div class="span4">
		<h3><?php echo JText::_('COM_NGTODO_PROJECTS')?> </h3>
		<div ng-controller="ProjectCtrl">
			<ul class="unstyled">
				<li ng-repeat="project in projects" ng-click="fetch(project.project_id)">
				<span class="project-title-{{project.project_id}}">{{project.project_name}}</span>
				</li>
			</ul>

			<form ng-submit="addProject()">
				<input type="project_name" ng-model="projectText" size="30"
					placeholder="<?php echo JText::_('COM_NGTODO_ADD_PROJECT_PLACEHOLDER')?>">
				<input class="btn btn-primary" type="submit"
					value="<?php echo JText::_('COM_NGTODO_ADD')?>">
			</form>
		</div>

	</div>

	<div class="span8">

	<div ng-controller="TodoCtrl">
		<!-- tasks -->
		<div ng-model="task_project_id" class="task_project_{{task_project_id}}">
		<h3><?php echo JText::_('COM_NGTODO_TASKS'); ?></h3>

			<span>{{remaining()}} of {{todos.length}} remaining</span> [ <a
				href="" ng-click="archive()">archive</a> ]
			<ul class="unstyled">
				<li ng-repeat="todo in todos" ><input type="checkbox"
					ng-model="todo.done"> <span class="done-{{todo.done}}">{{todo.task_name}}</span>
				</li>
			</ul>
			<form ng-submit="addTodo()">
				<input type="task_name" ng-model="todoText" size="30"
					placeholder="<?php echo JText::_('COM_NGTODO_ADD_TASK_PLACEHOLDER')?>">
									<input class="btn btn-primary" type="submit"
					value="<?php echo JText::_('COM_NGTODO_ADD'); ?>">
			</form>
			<div class="error" ng-model="errorContainer">{{errorTask}}</div>
		</div>
	</div>


	</div>

</div>
</div>

