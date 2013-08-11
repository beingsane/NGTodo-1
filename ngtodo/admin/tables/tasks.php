<?php // No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );


class TableTasks extends JTable {

	function __construct (&$db) {

		parent::__construct('#__ngtodo_tasks', 'task_id', $db);
	}

}