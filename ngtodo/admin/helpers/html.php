<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

class NGTodoHelpersHtml {

	public static function loadStrapper() {

		$document = JFactory::getDocument();
		//$document->addStyleSheet(JUri::root(true).'/media/ngtodo/css/bootstrap.css');
		$document->addStyleSheet(JUri::root(true).'/media/ngtodo/css/bootstrap-glyphicons.css');

		//script
		$document->addScript(JUri::root(true).'/media/ngtodo/js/angular.js');
		$document->addScript(JUri::root(true).'/media/ngtodo/js/ngboot.js');

	}

	public static function loadNGFiles($file) {

		$document = JFactory::getDocument();
		$filename = $file.'.js';
		$url = JUri::root(true).'/media/ngtodo/js/';
		$path = JPATH_SITE.'/media/ngtodo/js/';
		if(JFile::exists($path.$filename)) {
			$document->addScript($url.$filename);
		}

	}



}