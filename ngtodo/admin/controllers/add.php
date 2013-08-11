<?php

class NGTodoControllersAdd extends NGTodoControllersDisplay {

	function execute() {

		// Get the application
		$app = $this->getApplication();

		// Get the document object.
		$document = JFactory::getDocument();

		$viewName = $app->input->getWord('view', 'display');
		$viewFormat = $document->getType();
		$layoutName = $app->input->getWord('layout', 'default');

		$app->input->set('view', $viewName);
		$app->input->set('table', $viewName);

		// Register the layout paths for the view
		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT_ADMINISTRATOR . '/views/' . $viewName . '/tmpl', 'normal');

		$viewClass = 'NGTodoViews' . ucfirst($viewName) . ucfirst($viewFormat);
		$modelClass = 'NGTodoModels' . ucfirst($viewName);

		if (false === class_exists($modelClass))
		{
			$modelClass = 'NGTodoModelsDefault';
		}

		//initialise model
		$model = new $modelClass();

		$data = array();

		//get the JSON data sent by angular js controllers. You cannot use the regular input getting methods
		//because they do not support getting the JSON output.
		$input = new JInputJSON();
		$json = $input->getRaw();
		$post = json_decode($json);

		if($row = $model->store($post)) {
			$data['success'] = 1;
			$data['msg'] = JText::_('COM_NGTODO_PROJECT_ADD_SUCCESS');
		} else {
			$data['success'] = 0;
			$data['msg'] = JText::_('COM_NGTODO_PROJECT_ADD_FAILED');
		}

		//for better security, add a prefix before echoing
		$prefix =")]}',\n";

		$json = json_encode($data);

		echo $prefix.$json;
		$app->close();
	}



}