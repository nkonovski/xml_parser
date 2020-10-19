<?php

class BookController {

	private $model;
	private $view = 'BookView';
	private $template = 'list';
	private $errors;
	private $data = array();
	
	public $id_object = 0;
	
	public function __construct($id) {
	
		$this->id_object = (int)$id;

		if ($this->id_object > 0) {
			$this->model = new Book($this->id_object);
		} else {
			$this->model = new Book();
		}
	}

	/**
	* Start controller
	*/
	public function run(){

		$this->checkActions();
		$this->output();
	}

	/**
	* check POST for actions
	*/
	private function checkActions(){

		if(isset($_POST['doScan'])){
			if ($this->model->scan()){
				$this->errors[] = 'The scan was completed successfully.';
			} else {
				$this->errors[] = 'Oops, something goes wrong!';
			}
		} else if (isset($_POST['doSearch'])) {
			$this->actionSearch();
		}

	}

	/**
	* Get keyword from POST
	* load proper data
	*/
	private function actionSearch() {
		$keyword = $_POST['keyword'];
		$this->data = $this->model->search($keyword);
		$this->template = 'search';
		if (empty($this->data)){
			$this->$errors[] = 'Sorry no results found.';
		}
	}

	/**
	* print view
	*/
	private function output() {

		require_once(__ROOT__ . '/view/'.$this->view.'.php');
		$view = new $this->view($this->model, $this->errors);

		switch ($this->template) {
			case 'single':
				$view->displaySingle();
				break;
			case 'search':
				$view->displayList($this->data);
				break;
			case 'list':
			default:
				$view->displayList($this->model->getList(10));
				break;
		}
	}

}