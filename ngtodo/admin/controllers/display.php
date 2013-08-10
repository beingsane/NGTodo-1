<?php // No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

class NGTodoControllersDisplay extends JControllerBase {

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

		$view->setLayout($layoutName);

		// Render our view.
		echo $view->render();

		return true;
	}


}

