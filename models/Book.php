<?php

require_once Model.php;

class Book extends  Model{

    /** @var string book name */
	public $name;
	/** @var string book author */
	public $author;
	/** @var string Object creation date */
	public $date_add;
	/** @var string Object last update date */
	public $date_upd;

	 /**
     * @see Model::$definition
     */
	public static $definition = array(
		'table' => 'book',
		'primary' => 'id_book',
		'fields' => array(
			'name' =>        array('type' => self::TYPE_STRING, 'validate' => 'inGenericName',),
			'author' =>        array('type' => self::TYPE_INT, 'validate' => 'inGenericName'),
			'date_add' =>        array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			 'date_upd' =>        array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
		),
	);

	
	/**
	* Scan file structure recursivly.
	*/
	public function scaner($dir){
		
	
	}
	
	protected function readXml($file){
	
		
	
	}
}