<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

class NGTodoModelsTasks extends NGTodoModelsDefault {

	protected $_task_id = null;
	protected $_project_id = null;

	function __construct()
	{
		$app = JFactory::getApplication();
		$this->_task_id = $app->input->get('id', null);

		//get the project id
		$input = new JInputJSON();
		$json = json_decode($input->getRaw());
		if(isset($json->project_id)) {
			$this->_project_id = $json->project_id;
		}

		parent::__construct();
	}

	protected function _buildQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(TRUE);

		$query->select('t.*');
		$query->from('#__ngtodo_tasks as t');
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

		if(is_numeric($this->_task_id))
		{
			$query->where('t.task_id = ' . (int) $this->_task_id);
		}

		$query->where('t.project_id = ' . (int) $this->_project_id);
		return $query;
	}

}