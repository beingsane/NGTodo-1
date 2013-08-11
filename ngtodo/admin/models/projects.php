<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

class NGTodoModelsProjects extends NGTodoModelsDefault {

	protected $_project_id = null;

	function __construct()
	{
		$app = JFactory::getApplication();
		$this->_project_id = $app->input->get('id', null);

		parent::__construct();
	}

	protected function _buildQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(TRUE);

		$query->select('p.*');
		$query->from('#__ngtodo_projects as p');
		return $query;
	}

	public function getItem()
	{
		$book = parent::getItem();

		$reviewModel = new LendrModelsReview();
		$reviewModel->set('_book_id',$book->book_id);
		$book->reviews = $reviewModel->listItems();

		return $book;
	}

	/**
	 * Builds the filter for the query
	 * @param object Query object
	 * @return object Query object
	 *
	 */
	protected function _buildWhere($query)
	{

		if(is_numeric($this->_project_id))
		{
			$query->where('p.project_id = ' . (int) $this->_project_id);
		}

		return $query;
	}

}