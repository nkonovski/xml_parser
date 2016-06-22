
<?php

class Db
{
	/** @var array active instance */
    public static $instance;
	
	public $link
 
	public static getInstance(){
	
		if (!isset(self::$instance)) {
			// connect to postgre
			self::$instance = new Db();
		}
		
		return self::$instance;

	}
 
	/**
	* create connection
	*/
	public function _construct(){
		$this->link = new PDO("pgsql:dbname=".__DB_NAME__.";host=".__DB_HOST__, __DB_USER__, __DB_PASS__); 
	}
 
	public function update($table, $fields, $where){
	
	}
	
	public function insert($table, fields){
	
	}

	/**
	* execute query
	*/
	public function execute($sql){
	
		return $this->link->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	
	}
 
}