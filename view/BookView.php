<?php

class BookView(){
	
	//object 
	private $model;
	// array with errors/mesages
	private $errors;

	public function _construct($model, $errors){
	
		$this->model = $model;
		$this->errors = $errors;
	}

	/*
	* Display list of objects
	*/
	public displayList($data){

		$tpl_vars = array(
			'name' => 'Books',
			'data' => $data,
			'errors' => $this->errors,
			'back_url' => '/index.php',
		);

		requre_once(_ROOT_'/view/templates/list.php');

	}

	/*
	* Display single record
	*/
	public displaySingle(){

		$tpl_vars = array(
			'name' => 'Books',
			'model' => $model,
			'errors' => $this->errors,
			'back_url' => '/index.php',
		);

		requre_once(_ROOT_'/view/templates/single.php');

	}

}