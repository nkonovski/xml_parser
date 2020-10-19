<?php

class BookView {
	
	//object 
	private $model;
	// array with errors/mesages
	private $errors;

	public function __construct($model, $errors){
	
		$this->model = $model;
		$this->errors = $errors ? $errors : [] ;
	}

	/*
	* Display list of objects
	*/
	public function displayList($data) {

		$tpl_vars = array(
			'name' => 'Books',
			'data' => $data ? $data : [],
			'errors' => $this->errors,
			'back_url' => '/index.php',
		);

		require_once(__ROOT__ . '/view/templates/list.php');
	}

	/*
	* Display single record
	*/
	public function displaySingle(){

		$tpl_vars = array(
			'name' => 'Books',
			'model' => $model,
			'errors' => $this->errors,
			'back_url' => '/index.php',
		);

		require_once(__ROOT__ . '/view/templates/single.php');
	}

}