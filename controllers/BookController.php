<?php

class BookController{

	public $model;
	
	public $id_object = 0;
	
	public function _construct(){
	
		$this->id_object = (int)$_REQUEST['id'];

		if($this->id_object > 0)
			$this->model = new Book($this->id_object);
		} else {
			$this->model = new Book();
		}
	
	}



}