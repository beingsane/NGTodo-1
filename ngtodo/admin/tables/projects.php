<?php // No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );


class TableProjects extends JTable {

	function __construct (&$db) {

		parent::__construct('#__ngtodo_projects', 'project_id', $db);
	}

}