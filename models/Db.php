
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

	/**
	* Concat update sql
	*/
	public function update($table, $fields, $where, $limit = null){

		if (!$data) {
			return true;
		}

		$sql = 'UPDATE `'.bqSQL($table).'` SET ';

		foreach ($fields as $key => $value) {
			$sql .= '`'.bqSQL($key).'` = '.$value.',';
		}
		$sql = rtrim($sql, ',');

		if ($where) {
			$sql .= ' WHERE '.$where;
		}

		if ($limit) {
			$sql .= ' LIMIT '.(int)$limit;
		}

		return (bool)$this->link->query($sql)

	}

	/**
	* Concat insert sql
	*/
	public function insert($table, fields){

		$keys = array();
		$values = array();
		foreach ($fields as $key => $value) {
			$keys[] = '`'.bqSQL($key).'`';
		    $values[] = $string_value = $value;
		}

		$keys_stringified = implode(', ', $keys);
		$sql = 'INSERT INTO `'.$table.'` ('.$keys_stringified.') VALUES '.implode(', ', $values);

		return (bool)$this->link->query($sql)
	
	}

	/**
	* execute query
	*/
	public function execute($sql){

		return $this->link->query($sql)->fetchAll(PDO::FETCH_ASSOC);

	}

}