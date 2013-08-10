<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

class NGTodoViewsDisplayHtml extends JViewHtml {

	function render() {

		$this->addToolBar();
		return parent::render();
	}

	function addToolBar() {

		JToolbarHelper::title(JText::_('COM_NGTODO'));
	}

}