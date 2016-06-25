<?php

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
	* Get data filtered by keyword
	*
	*@param string $keyword - author name
	*@return array
	*/
	public function search($keyword){

		if (empty($keyword)){
			return false;
		}

		$sql = 'SELECT * FROM `'.self::$definition['table'].'` '
			.' WHERE `author` LIKE \''.pSQL($keyword).'\' ';

		// get data from db
		if (!$result = Db::getInstance()->execute($sql) {
			return false;
		}

		return $result;

	}

	/**
	* Scan file structure recursivly.
	*@param string $dir - xml storage directory
	*@return int number of files
	*/
	public function scan($dir = null, $count = 0){
		
		if (empty($dir)){
			$dir = _DEFAULT_XML_DIR;
		}

		// read directory
		$dirHandle = opendir($dir);
		while($file = readdir($dirHandle)){

			//scan sub directory
			if(is_dir($dir.$file."/") && $file != '.' && $file != '..'){
				$count = $this->scan($dir.$file."/",$count);
			}
			else{
				//try to parse file
				if ($this->parseXml($file)){
					$count++;
				}
			}
		}

		return $count;

	}
	
	/**
	* Parse XML and save data int db
	*@param string $file - path to XML
	*@return bool
	*/
	protected function parseXml($file){
	
		//load simple xml object
		$xml = simplexml_load_file($file);

		if(!$xml){
			return false;
		}

		$res = true;
		foreach($xml as $book){
			// add new object for each book
			$obj = new Book();
			$obj->name = $book->name;
			$obj->author = $book->author;
			$res &= $obj->add();
		}

		return $res;

	}

}