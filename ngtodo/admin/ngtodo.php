<?php // No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

//load classes
JLoader::registerPrefix('NGTodo', JPATH_COMPONENT_ADMINISTRATOR);


//load tables
JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');

//Load plugins
JPluginHelper::importPlugin('ngtodo');

//application
$app = JFactory::getApplication();

//load stylesheers and documents
NGTodoHelpersHtml::loadStrapper();

// Require specific controller if requested
$controller = $app->input->get('controller','display');

// Create the controller
$classname = 'NGTodoControllers'.ucwords($controller);
$controller = new $classname();

// Perform the Request task
$controller->execute();