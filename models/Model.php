<?php

//CRUD operations
class Model(){

    /**
     * List of field types
     */
    const TYPE_INT     = 1;
    const TYPE_BOOL    = 2;
    const TYPE_STRING  = 3;
    const TYPE_FLOAT   = 4;
    const TYPE_DATE    = 5;
    const TYPE_HTML    = 6;
    const TYPE_NOTHING = 7;
    const TYPE_SQL     = 8;

    /** @var int Object ID */
    public $id;
	
	/**
     * @var array Contains object definition
     */
    public static $definition = array();

	/**
	* Load object
	*/
	public function __construct($id = null){
		if ($id) {
			
			$sql = 'SELECT * FROM `'.$definition['table'].'` WHERE `'.$definition['primary'].'` = '.(int)$this->id;
			if (!$fields = Db::getInstance()->execute($sql)) {
				return false;
			}
			foreach ($fields as $property => $value){
				$this->{$property} = $value;
			}
		}
	}
	
	
	/**
	*Add new object
	*
	*@param bool $auto_date
	*@return bool
	*/
	public function add($auto_date = true){
	
		// Automatically fill dates
		if ($auto_date && property_exists($this, 'date_add')) {
			$this->date_add = date('Y-m-d H:i:s');
		}
		if ($auto_date && property_exists($this, 'date_upd')) {
			$this->date_upd = date('Y-m-d H:i:s');
		}
		
		// save data into db
		if (!$result = Db::getInstance()->insert($this->def['table'], $this->getFields())) {
			return false;
		}

		return $result;
	}
	
	/**
	* Update existing object
	*
	*@return bool
	*/
	public function update($auto_date = true){
	
		// Automatically fill dates
		if (array_key_exists('date_upd', $this)) {
			$this->date_upd = date('Y-m-d H:i:s')
		}
	
	    // Database update
        if (!$result = Db::getInstance()->update($this->def['table'], $this->getFields(), '`'.pSQL($this->def['primary']).'` = '.(int)$this->id)) {
            return false;
        }
		
		return $result;
	}
	/**
	* save object
	*/
	public function save(){
	
		return (int)$this->id > 0 ? $this->update() : $this->add($auto_date);
	}
	
	/**
	* Delete record
	*/
	public function delete(){
	
	}
	
	/**
	* colect fields and data
	*/
	public function getFields()
    {
		$this->validateFields();
		$fields = $this->formatFields();

		return $fields;
    }
	
	/**
	* validate fields values
	*/
	public function validateFields(){
		//TODO validate fields based on type in definition
	}
	
	/**
	* format fields values depend of their type
	*/
	protected function formatFields()
    {
        $fields = array();
        // Set primary key in fields
        if (isset($this->id)) {
            $fields[$this->def['primary']] = $this->id;
        }
		foreach ($this->def['fields'] as $field => $data) {
			// Get field value
			$value = $this->$field;		
			// Format field value
			$fields[$field] = Model::formatValue($value, $data['type']));
		}
		return $fields;
	}
	/**
	* Format type
	*/
	public static function formatValue($value, $type)
    {
        switch ($type) {
            case self::TYPE_INT:
                return (int)$value;
            case self::TYPE_BOOL:
                return (int)$value;
            case self::TYPE_FLOAT:
                return (float)str_replace(',', '.', $value);
            case self::TYPE_DATE:
                if (!$value) {
                    return '0000-00-00';
                }
                return pSQL($value);
            case self::TYPE_HTML:
                return pSQL($value, true);
            case self::TYPE_NOTHING:
                return $value;
            case self::TYPE_STRING:
            default :
                return pSQL($value);
        }
    }

}