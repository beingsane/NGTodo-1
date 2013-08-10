<?php

class NGTodoControllersAjax extends NGTodoControllersDisplay {

	function execute() {

		// Get the application
		$app = $this->getApplication();

		// Get the document object.
		$document = JFactory::getDocument();

		$viewName = $app->input->getWord('view', 'display');
		$viewFormat = $document->getType();
		$layoutName = $app->input->getWord('layout', 'default');

		$app->input->set('view', $viewName);

		// Register the layout paths for the view
		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT_ADMINISTRATOR . '/views/' . $viewName . '/tmpl', 'normal');

		$viewClass = 'NGTodoViews' . ucfirst($viewName) . ucfirst($viewFormat);
		$modelClass = 'NGTodoModels' . ucfirst($viewName);

		if (false === class_exists($modelClass))
		{
			$modelClass = 'NGTodoModelsDefault';
		}

		$view = new $viewClass(new $modelClass, $paths);

		$data = array();
		$data[0]['text'] = 'learn angular';
		$data[0]['done'] = 1;
		$data[1]['text'] = 'build an angular app';
		$data[1]['done'] = 1;

		//for better security, add a prefix before echoing
		$prefix =")]}',\n";

		$json = json_encode($data);

		echo $prefix.$json;
		$app->close();
	}



}